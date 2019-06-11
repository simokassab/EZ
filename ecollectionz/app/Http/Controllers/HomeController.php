<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Session;
use DateTime;
use PDF;
use File;
use Response;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
       // echo auth()->user()->phone;
        DB::enableQueryLog();
        $id = Auth::user()->id;
        $corp = DB::table('users')
            ->join('policies', 'users.phone', '=', 'policies.phone')
            ->join('corporates', 'policies.cust_id', '=', 'corporates.id')
            ->select(DB::raw('DISTINCT(corporates.id) as CPP'), 'corporates.name',
                    'corporates.email', 'corporates.phone', 'corporates.address', 'corporates.photo')
            ->where('users.id', '=', $id)->get();

       
      //  dd($corp);
       // dd(DB::getQueryLog());
        return view('home')->with('corp', $corp);
    }

    public function linkedAccounts(){
        $id = Auth::user()->id;
        DB::enableQueryLog();
        $linked = DB::table('users')
        ->join('policy_requests', 'users.id', '=', 'policy_requests.USER_ID_FK')
        ->join('policies', 'policies.phone', '=', 'policy_requests.phone')
        ->join('corporates', 'corporates.id', '=', 'policies.cust_id')
        ->select(DB::raw('DISTINCT(corporates.id) as CPP'), 'corporates.name',
            'corporates.email', 'corporates.phone', 'corporates.address', 'corporates.photo', 'policies.client_name as PNAME', 'policies.phone as PPHONE')
        ->where('users.id', '=', $id)
        ->where('policy_requests.status', '=', "DONE")
        ->get();
        //return 'ok';
        //dd(DB::getQueryLog());
        return view('clients.linked')->with('linked',$linked); 
    }

    public function getHistory(){
        $phone = auth()->user()->phone;
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
        B.*
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
       where  B.phone='.$phone.' and B.status="P-online"');

       return view ('clients.history')->with('policies', $policies);
    }

    public function feedback(){
        $phone = auth()->user()->phone;
       return view ('clients.feedback');
    }

    public function getFeedback(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $message = $request->input('message');
        $cenvertedTime = date('Y-m-d H:i:s');
        DB::table('feedback')->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);
        DB::table('notifications_admin')->insert([
            'title' => 'New Feedback ',
            'type' => 'normal',
            'to_' => '',
            'from_' => $id = Auth::user()->id,
            'body' => 'New Feedback  has been added, click for more info',
            'href' => URL_.'admin/feedback',
            'scheduled' => $cenvertedTime
        ]);

       // return redirect()->back()->with('message', 'Your feedback has been sent successfully, will return to you ASAP!');
    
    }

    public function getPolicies($id){
        $phone = auth()->user()->phone;
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
        B.*
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
        and B.cust_id='.$id.' and B.phone='.$phone);

        //$policies=DB::table('policies')->where('cust_id', '=', $id)->where('phone', '=', $phone)->get();
        $corp = DB::table('corporates')->where('id', $id)->get();

        return view ('clients.policies')->with('policies', $policies)->with('corp', $corp);
    }

    public function getLinkedPolicies($phone, $id){
        //$phone = auth()->user()->phone;
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
        B.*
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
        and B.cust_id='.$id.' and B.phone='.$phone);
        $corp = DB::table('corporates')->where('id', $id)->get();

        return view ('clients.policies_linked')->with('policies', $policies)->with('corp', $corp);
    }

    public function downloadReceipt($rid, $draft){
        $phone = auth()->user()->phone;
        return storage_path().'/'.$phone.'/'.$rid.'_'.$draft.'.pdf';
    }

    public function getPDF($RID)
    {
        $policies = DB::table('policies')
            ->join('receipts', 'policies.id', 'receipts.POLICY_ID_FK')
            ->join('corporates', 'policies.cust_id', 'corporates.id')
            ->select('policies.*', 'receipts.id as RID', 'receipts.STAMP_ID_FK', 'corporates.name as cp_name')
            ->where('receipts.id', $RID)->get();
        $draft = explode('/', $policies[0]->draft_no);
        $path = storage_path() . '/' . $policies[0]->phone . '/' . $RID . '_' . $draft[0] . '_temp.pdf';
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $RID . '_' . $draft[0] . '_temp.pdf"'
        ]);
    }

    public function newPolicy(){
        $corp = DB::table('corporates')->get();
        return view('clients.policy')->with('corp', $corp);
    }

    public function store (Request $request){
        DB::table('policy_requests')->insert([
            'USER_ID_FK' => auth()->user()->id,
            'CP_ID_FK' => $request->input('corporates'),
            'phone' => $request->input('phone'),
            'policy' => $request->input('policy_no'),
            'client_number' => $request->input('client_no'),
            'status' => "PENDING"
        ]);
        DB::table('notifications_admin')->insert([
            'title' => 'New Policy Request',
            'type' => 'normal',
            'to_' => '',
            'from_' => Auth::user()->id,
            'body' => 'New Policy Request from '.Auth::user()->name,
            'href' => URL_.'admin/p_requests',
            'scheduled' => date('Y-m-d H:i:s')
        ]);

        return back()->with('success', "Your Request has been sent successfully ");
    }

    public function checkOut($id){
        DB::enableQueryLog();
        $date = date('Y-m-d');
        $user_id = auth()->user()->id;
        $data = DB::table('policies')
            ->join('corporates', 'policies.cust_id', '=', 'corporates.id')
            ->join('users', 'policies.phone', '=', 'users.phone')
            ->select('policies.*','users.id as ID','users.name as name', 'users.address as US_ADD',
                'users.city as city', 'users.country as country',   'users.email as email', 'corporates.name as CP_NAME',
                'corporates.collect_fees as C_FEES', 'corporates.net_c_fees as N_FEES')
            ->where('policies.id', '=',$id)->get()->toArray();
       // foreach ($data as $d){
            $order_id = DB::table('payment_orders')->insertGetId([
                'from_' => $user_id,
                'policy_id' => $id,
                'status' => 'WAITING',
                'order_date' => $date
            ]);
       // }
       dd(DB::getQueryLog());
        return view('clients.checkout')->with('data', $data)->with('order_id', $order_id);
    }

    public function checkOutLinked($id){
        DB::enableQueryLog();
        $date = date('Y-m-d');
        $user_id = auth()->user()->id;
        $data = DB::table('users')
        ->join('policy_requests', 'users.id', '=', 'policy_requests.USER_ID_FK')
        ->join('policies', 'policies.phone', '=', 'policy_requests.phone')
        ->join('corporates', 'corporates.id', '=', 'policies.cust_id')
            ->select('policies.*','policies.client_name as CNAME' ,'users.id as ID', 'users.address as US_ADD',
                'users.city as city', 'users.country as country',   'users.email as email', 'corporates.name as CP_NAME',
                'corporates.collect_fees as C_FEES', 'corporates.net_c_fees as N_FEES')
            ->where('policies.id', '=',$id)->get()->toArray();
       // foreach ($data as $d){
            $order_id = DB::table('payment_orders')->insertGetId([
                'from_' => $user_id,
                'policy_id' => $id,
                'status' => 'WAITING',
                'order_date' => $date
            ]);
       // }
     //  dd(DB::getQueryLog());
        return view('clients.checkout_linked')->with('data', $data)->with('order_id', $order_id);
    }


    /*
        *
           txtIndex=10024
           txtMerchNum=01999131
           txtAmount=56.38
           txtCurrency=840
           NC Returned signature=30ad5ec315d36c5d334b9786b3907e4c4f43fcdefc9cb44aea8b86342581d420
           txtNumAut=000000
           RespVal=0
           RespMsg=Invalid Card Status
        * */
    public function checkOutOrderID($txtIndex, $signature){
        $ids=explode('-', $txtIndex);
        DB::table('payment_orders')->where('id', $ids[0])->update([
            'signature' => $signature
        ]);

    }

    public function paymentStatus(Request $request){
        DB::enableQueryLog();
       $status = $request->input('RespVal');
        $ids = explode('-',$request->input('txtIndex'));

        $p_id=DB::table('payment_orders')->where('id', $ids[0])->pluck('policy_id');

        $cust_id =DB::table('policies')->where('id', $p_id)->get();
        //SHA256(txtMerchNum&txtIndex&txtAmount&txtCurrency&txtNumAut&RespVal&RespMsg&sha_key
        $sig = hash('sha256', $request->input('txtMerchNum').$request->input('txtIndex').$request->input('txtAmount')
        .$request->input('txtCurrency').$request->input('txtNumAut').$request->input('RespVal').
        $request->input('RespMsg').'TEST');
        //if same signature, so ok
        if($request->input('signature') == $sig){
            if($status==1){
                $s='Authorized';
                $s1='P-online';
                $mytime = Carbon::now();
                DB::table('policies')->where('id', $p_id)->update([
                    'status' => $s1,
                    'paid_at' => date('Y-m-d'),
                    'remarks' => $request->input('RespMsg'). " - ".$ids[0],
                    'created_at' => $mytime->toDateTimeString()
                ]);
                
            }
            else {
                $s='Refused';
                $s1='F';
                DB::table('policies')->where('id', $p_id)->update([
                    'status' => $s1,
                    'remarks' => $request->input('RespMsg')." - ".$ids[0]
                ]);
            }
            $val='';
            $datenow = new DateTime("now");
            $due_date = new DateTime(Session::get('DUEDATE'));
            $interval = $datenow->diff($due_date);
            $diff = $interval->format('%R%a');
            if ($diff < -3) {
                $d = ($diff + 3) * 5;
                $val = 100 + ($d);
            }
            else {
                $val=100;
            }
            DB::table('gpa')->insert([
                'US_PHONE' => Session::get('CPHONE'),
                'draft' => Session::get('DRAFTNO'),
                'status' => 'P-online',
                'value' => $val
            ]);
            //update status in payments order
            DB::table('payment_orders')
                ->where('id', $ids[0])
                ->update([
                    'txtAmount' =>  $request->input('txtAmount'),
                    'txtCurrency' =>  $request->input('txtCurrency'),
                    'signature' =>  $request->input('signature'),
                    'txtNumAut' =>  $request->input('txtNumAut'),
                    'RespVal' =>  $request->input('RespVal'),
                    'RespMsg' =>  $request->input('RespMsg'),
                    'status' =>  $s,

                ]);
            $phone = auth()->user()->phone;
            $policies=DB::table('policies')->where('cust_id', '=', $cust_id[0]->cust_id)->where('phone', '=', $phone)->get();
            //  dd($corp);
            //DB::table('payment_orders')->where('txtAmount', NULL)->delete();
            if($request->input('RespVal')==1){
                $stamp_id=DB::table('stamp_'.$policies[0]->cust_id)->insertGetId([
                    'maxx' => 150000,
                    ]);
                $stamps =DB::table('stamp_'.$policies[0]->cust_id)->get();
                $RID=DB::table('receipts')->insertGetId([
                    'CUST_ID_FK' => $cust_id[0]->cust_id,
                    'POLICY_ID_FK' => $cust_id[0]->id,
                    'STAMP_ID_FK' => $stamps[0]->id
                ]);
                $policies = DB::table('policies')
                    ->join('receipts', 'policies.id', 'receipts.POLICY_ID_FK')
                    ->join('corporates', 'policies.cust_id', 'corporates.id')
                    ->select('policies.*', 'receipts.id as RID', 'receipts.STAMP_ID_FK', 'corporates.name as cp_name')
                    ->where('receipts.id', $RID)->get();
                //foreach($policies as $r){
                $LBP= 1515 * $request->input('txtAmount');
                if (strpos($policies[0]->draft_no, '/') !== false) {
                    $draft = explode('/', $policies[0]->draft_no);
                }
                else {
                    $draft = explode('\\', $policies[0]->draft_no);  
                }
                $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
                $word = $f->format($policies[0]->amount);
                $data_temp = [

                    'receipt_id' => $RID,
                    'amount' => $request->input('txtAmount'),
                    'amount1' => $LBP,
                    'client_id' => $policies[0]->client_id,
                    'policy' => $policies[0]->policy,
                    'client_no' => $policies[0]->client_no,
                    'client_name' => $policies[0]->client_name,
                    'cp_name' => $policies[0]->cp_name,
                    'due_date' => $policies[0]->due_date,
                    'draft' => $draft[0],
                    'sum' => $word.' USD ONLY',
                    'sum' => $word.' USD ONLY',
                    'paid_at' => $policies[0]->paid_at,
                ];

                
                $data = [
                    'receipt_id' => $RID,
                    'amount' => $request->input('txtAmount'),
                    'amount1' => $LBP,
                    'client_id' => $policies[0]->client_id,
                    'policy' => $policies[0]->policy,
                    'client_no' => $policies[0]->client_no,
                    'client_name' => $policies[0]->client_name,
                    'cp_name' => $policies[0]->cp_name,
                    'due_date' => $policies[0]->due_date,
                    'draft' => $draft[0],
                    'sum' => $word.' USD ONLY',
                    'sum' => $word.' USD ONLY',
                    'paid_at' => $policies[0]->paid_at,
                    'stamp' => $stamps[0]->maxx."\\".$stamps[0]->id,
                ];
                //   }
                //temporary receipt
                $pdf_temp= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('receipts.150_temp', $data_temp);

                $path=storage_path().'/'.$policies[0]->phone;
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                $pdf_temp->save($path.'/'.$RID.'_'.$draft[0].'_temp.pdf');
                //official receipt
                $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('receipts.150', $data);

                $path=storage_path().'/'.$policies[0]->phone;
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                $pdf->save($path.'/'.$RID.'_'.$draft[0].'.pdf');
                $startTime = date("Y-m-d H:i:s");
                $cenvertedTime = date('Y-m-d H:i:s',strtotime('+7 days',strtotime($startTime)));
                DB::table('notifications_admin')->insert([
                    'title' => 'Receipt',
                    'type' => 'normal',
                    'to_' => '',
                    'from_' => '',
                    'body' => 'You have new receipt to sent today',
                    'href' => URL_.'admin/receipts',
                    'scheduled' => $cenvertedTime
                ]);

                $orderr=DB::table('payment_orders')->where('id', $ids[0])->get();
                //dd(DB::getQueryLog());
                return view('clients.order')
                    ->with('policies', $policies)
                    ->with('orderr', $orderr)
                    ->with('RID', $RID)
                    ->with('draft', $draft[0])
                    ->with('success', "Your draft has been successfully PAID, download your receipt below");
            }
            else {
                $orderr=DB::table('payment_orders')->where('id', $ids[0])->get();
                return view('clients.order')
                    ->with('policies', $policies)
                    ->with('orderr', $orderr)
                    ->with('error', "Your draft not PAID due ".$request->input('RespMsg'));
            }
        }
        else {
            DB::table('payment_orders')->where('txtAmount', NULL)->delete();
            return redirect ($cust_id[0]->cust_id.'/policies')->with('error', 'Security Violation Was detected! please try again later or contact the admin');
        }
    }

    public function getProfile(){
        $id= Auth()->user()->id;
        $profile =DB::table('users')
            ->where('id', $id)
            ->get();
        return view('clients.profile')->with('profile',$profile);
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);
        $id= Auth()->user()->id;
        $file = $request->file('photo');
        if ($file !=''){
            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            $nameimg = $file->getClientOriginalName();
            $file->move(public_path('images'), $nameimg);
            $name= $request->input('name');
            $email= $request->input('email');
            $phone= $request->input('phone');
            $country= $request->input('country');
            $city= $request->input('city');
            $address= $request->input('address');
            DB::table('users')->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'country' => $country,
                'city' => $city,
                'address' => $address,
                'photo' => $nameimg,
            ]);
        }
        else {
            $name= $request->input('name');
            $email= $request->input('email');
            $phone= $request->input('phone');
            $country= $request->input('country');
            $city= $request->input('city');
            $address= $request->input('address');
            DB::table('users')->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'country' => $country,
                'city' => $city,
                'address' => $address
            ]);
        }
        return redirect('./profile')->with('success', 'Your profile has been updated !');
    }
}
