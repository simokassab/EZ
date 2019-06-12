<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class AdminCpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corp = DB::table('corporates')->get();
        $corp1 = DB::table('corporates')->orderBy('created_at', 'DESC')->take(3)->get();
        return view('adm.corporates.corporate')->with('corp', $corp)->with('corp1', $corp1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // DB::enableQueryLog();
        $file = $request->file('photo');
        $nameimg = $file->getClientOriginalName();
        $file->move(public_path('images'), $nameimg);
        DB::table('corporates')->insert([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), 
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'photo' => $nameimg,
            'pay_online' => $request->input('pay_online'),
            'collect_fees' => $request->input('collect_fees'),
            'net_c_fees' => $request->input('net_c_fees'),
            'gpa' => $request->input('gpa')
        ]);
        
        $this->name =$request->input('name');
        $this->email =$request->input('email');
        $this->password =$request->input('password');
          Mail::send([],[], function ($message) {
            $message->from('info@ecollectionz.com', 'ECOLLECTIONZ INFO');
            $message->sender('info@ecollectionz.com', 'info@ecollectionz.com');
            $message->to( $this->email, $this->name);
            $message->subject('EcollectionZ New Corporate User');
            $message->setBody('<h1>Dear  '.$this->name.',</h1><br/>
                    <p><i>Thank you for your registration and welcome to Ecollectionz! 
                    Your profile request has been successfully submitted.
                     Feel free to browse the website to benefit from our services and keep track of exceptional offers.
                     <a href="www.ecollectionz.com">www.ecollectionz.com</a>
                     Our team is always there to provide you with the best help and support. 
                    For further questions and information, feel free to contact us:
                    <a href="mailto:info@ecollectionz.com">info@ecollectionz.com</a>
                    :</i></p><br/>
                            <ul>
                                <li>Email: '. $this->email.'</li>
                                <li>Password: '.$this->password.'</li></ul>
                            <h2>Best regards,
                                Ecollectionz Team.
                                </h2><br/><br/>
                            <h6 style="color: green">Save a tree... please don\'t print this e-mail unless you really need to</h6>
                            <h6>Beirut - Lebanon</h6>', 'text/html');
        });
         //dd(DB::getQueryLog());
         return back()->with('success', "Corporate ".$request->input('name')." has been created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $corp = DB::table('corporates')->where('id',$id)->get();
        return view('adm.corporates.edit')->with('corp',$corp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' =>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $file = $request->file('photo');
        if ($file !=''){
            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            $nameimg = $file->getClientOriginalName();
            $file->move(public_path('images'), $nameimg);
            DB::table('corporates')
                ->where('id', $id)
                ->update([
                    'id' =>  $request->input('id'),
                    'name' =>  $request->input('name'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'photo' =>  $nameimg,
                    'pay_online' => $request->input('pay_online'),
                    'collect_fees' => $request->input('collect_fees'),
                    'net_c_fees' => $request->input('net_c_fees'),
                    'gpa' => $request->input('gpa')
                ]);
        }
        else {
            DB::table('corporates')
                ->where('id', $id)
                ->update(['name' =>  $request->input('name'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'pay_online' => $request->input('pay_online'),
                    'collect_fees' => $request->input('collect_fees'),
                    'net_c_fees' => $request->input('net_c_fees'),
                    'gpa' => $request->input('gpa')
                ]);
        }
       // $corp = DB::table('corporates')->get();
        return redirect('/admin/corporate')->with('success', "Corporate ".$request->input('name')." has been  successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('corporates')->where('id', $id)->update(['active' => 0]);
        //$corp = DB::table('corporates')->get();
         return redirect('/admin/corporate')->with('error', "Corporate has been  desactivated");
    }

    public function activate($id)
    {
        DB::table('corporates')->where('id', $id)->update(['active' => 1]);
        //$corp = DB::table('corporates')->get();
         return redirect('/admin/corporate')->with('success', "Corporate has been  activated");
    }

    public function getBrokers($id)
    {
        $cp = DB::table('corporates')->where('id', $id)->get();
       // $brokers = DB::table('brokers')->where('CP_ID_FK', $id)->get();
         $brokers = DB::table('brokers')
                   ->join('corporates', 'brokers.CP_ID_FK', '=', 'corporates.id')
                   ->select('corporates.name as CP_NAME','corporates.id as CP_ID', 'corporates.pay_online as CP_PAY', 'brokers.*')
                   ->where('CP_ID_FK', $id)->get();
        //$corp = DB::table('corporates')->get();
         return view('adm.corporates.getbrokers')->with('brokers',$brokers)->with('cp', $cp);
    }

    public function getClients($id)
    {
        DB::enableQueryLog();
        $cp = DB::table('corporates')->where('id', $id)->get();
        // $brokers = DB::table('brokers')->where('CP_ID_FK', $id)->get();
        $clients = DB::table('policies')
        ->leftJoin('users', 'policies.phone', 'users.phone')
        
        ->select(DB::raw('DISTINCT(policies.phone) as PHONE'), 'users.email', 'client_name', 'client_no', 
        'client_id', 'policies.address', 'policy' )
            ->where('cust_id', $id)->get();
        //dd(DB::getQueryLog());
        //$corp = DB::table('corporates')->get();
        return view('adm.corporates.getclients')->with('clients',$clients)->with('cp', $cp);
    }

    public function getPolicies($id)
    {
        DB::enableQueryLog();
        $cp = DB::table('corporates')->where('id', $id)->get();
        // $brokers = DB::table('brokers')->where('CP_ID_FK', $id)->get();
       
        return view('adm.corporates.getpolicies')->with('cp', $cp);
    }

    public function getDatatable($cust){
        
        $policies = DB::select('
        SELECT corporates.name as CP_NAME, B.cust_id as CID,
        B.client_no, B.client_name, B.phone,
        B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
        where B.cust_id='.$cust);
       // $info['data']= json_encode($policies);
        return   json_encode($policies);
    }

    public function getPoliciesByStatus($status)
    {
        DB::enableQueryLog();
       // $cp = DB::table('corporates')->where('id', $id)->get();
        // $brokers = DB::table('brokers')->where('CP_ID_FK', $id)->get();
        if($status=='UN'){
            $policies = DB::table('policies')
                ->where('status', '')->get();
        }
        else {
            $policies = DB::table('policies')
                ->where('status', $status)->get();
        }

       // dd(DB::getQueryLog());
        //$corp = DB::table('corporates')->get();
        return view('adm.getstatus')->with('policies',$policies)->with('status', $status);
    }



    
}
