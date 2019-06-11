<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\policies;
use  Auth;
use Mail;
use Hash;
use DateTime;
use DatePeriod;
use DateInterval;

class CorporateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:corporate');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        DB::enableQueryLog();
       // dd(Auth::user());
        $id = Auth::user()->id;
        //return Auth::user()->id;
        $paid_policies = DB::select(' SELECT count(B.id) as P_COUNT FROM ( select client_name, phone, draft_no, 
        status, max(created_at) as created_at from policies group by client_name, phone, draft_no ) A 
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id where B.cust_id='.$id.' and B.status = "P"');
        //
        $unpaid_policies = DB::select(' SELECT count(B.id) as P_COUNT FROM ( select client_name, phone, draft_no, 
        status, max(created_at) as created_at from policies group by client_name, phone, draft_no ) A 
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id where B.cust_id='.$id.'  and B.status <> "P"');
       // dd(DB::getQueryLog());
       //
        $summary =  DB::select('SELECT count(B.id)as COUNT, B.status  FROM ( select client_name, phone, draft_no, 
        status, max(created_at) as created_at from policies group by client_name, phone, draft_no ) A 
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id where B.cust_id='.$id.'  GROUP BY B.status');
        return view('corporates.dashboard')->with('paid_policies', $paid_policies)
            ->with('unpaid_policies', $unpaid_policies)
            ->with('summary', $summary);
    }

    public function getClients(){
        $id = Auth::user()->id;
        $gpa = DB::table('corporates')->where('id', $id)->get();
        $clients = DB::table('policies')
            ->leftJoin('users', 'policies.phone', '=', 'users.phone')
            ->leftJoin('gpa', 'policies.phone', '=', 'gpa.US_PHONE')
            ->select(DB::raw('DISTINCT(policies.client_name) as CNAME'),
                DB::raw('ROUND(SUM(value)/COUNT(value),1) as GPAA'),'users.email as EMAILS', 'policies.phone as PPHONE', 'client_name', 'client_no', 'client_id',
                'policies.address as ADDR', 'policy'
            )
            ->where('cust_id', $id)
            ->groupBy('policies.client_name')->get();

        return view ('corporates.clients')->with('clients', $clients)->with('gpa', $gpa);
    }

    public function getPoliciesByClient($phone){
        DB::enableQueryLog();
        $id = Auth::user()->id;
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
        B.client_no, B.id, B.client_name, B.phone,
        B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
        where B.cust_id='.$id.' and B.phone='.$phone);
        //dd(DB::getQueryLog());
        return view('corporates.policies')->with('policies', $policies);

    }

    public function getAllPolicies (){
        DB::enableQueryLog();
        $id = Auth::user()->id;
      //  $search=DB::table('policies')->where('cust_id', '1234567890');
        $policies = DB::select('
        SELECT corporates.name as CP_NAME, B.* FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id

        where B.cust_id='.$id);
        //  dd(DB::getQueryLog());
        return view('corporates.allpolicies');
    }

    public function getDatatable(){
      $id = Auth::user()->id;
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
        B.client_no, B.client_name, B.phone,
        B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
        and B.cust_id='.$id);

        return $policies;
    }

    public function getHistory($id){
        $str = explode('_', $id);
        $cp_id = Auth::user()->id;
        $phone=$str[0];
        $draft=$str[1];
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
        $name=$str[2];
        $history = DB::table('policies')
            ->where('client_name', $name)
            ->where('policies.phone', $phone)
            ->where('draft_no', $draft)
            ->where('policies.cust_id', $cp_id)
            ->select('policies.*')
            ->get();
        return view('corporates.history')->with('history', $history);
    }


    public function searchPolicies (){
        $id = Auth::user()->id;
        $search=DB::table('policies')->where('cust_id', '11111111')->get();
        return view('corporates.searchpolicies')->with('search', $search);
    }

    public function getSearchPolicies (Request $request){
        DB::enableQueryLog();
        $id = Auth::user()->id;
        $type= $request->input('dateype');
        $d = $request->input('dates');
        $status = $request->input('status');
        $where=' where ';
        $where.= ' B.cust_id='.$id.' AND ';
        $polic =policies::where('cust_id', '=', $id);
        if($d !=0){
            $dates =explode(' - ', $d);
            $s = strtotime($dates[0]);
            $e = strtotime($dates[1]);
            $sdate =date('Y-m-d',$s);
            $edate =date('Y-m-d',$e);
            $where.=" (B.".$type." BETWEEN '".$sdate."' AND '".$edate."') AND ";
            $polic->whereBetween($type, [$sdate, $edate]);
        }
        if($status !='null'){
            if ($status=='UN'){
                
                $where.=" B.status ='' AND ";
            }
            else {
                $where.=" B.status ='".$status."' AND ";
            }
            // $where.=" and  ( status='$status' )";
           
        }
        $where = substr($where, 0, -4);
        $search = DB::select('
        SELECT corporates.name as CP_NAME,
        B.client_no, B.client_name, B.phone,
        B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id '.$where);
       // dd(DB::getQueryLog());
        return view('corporates.searchpolicies')->with('search', $search)->with('request', $request);
    }

    public function getComments($p_id){

        //$id = Auth::user()->id;
        DB::enableQueryLog();
        $str = explode('_', $p_id);
        $corp=$str[0];
        $draft=$str[1];
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
        $phone=$str[2];
        $policies = DB::table('policies')
        ->where('cust_id', $corp)
        ->where('draft_no', $draft)
        ->where('phone', $phone)
            ->get();

        $comments = DB::table('comments')
        ->join('corporates', 'comments.corporate_id', 'corporates.id')
                ->where('corporate_id', $corp)
                ->where('draft_no', $draft)
                ->where('comments.phone', $phone)
            ->select('comments.*', 'corporates.*', 'comments.id as CID')
            ->get();
        $replies = DB::table('comments')->leftJoin('replies', 'comments.id', '=', 'replies.comment_id')
            ->where('corporate_id', $corp)
            ->where('draft_no', $draft)
            ->where('comments.phone', $phone)
            ->get();
       // dd(DB::getQueryLog());


        return view('corporates.comments')->with('comments', $comments)->with('replies', $replies)->with('policies', $policies);
    }

    public function getPoliciesByStatus($status)
    {
        $id = Auth::user()->id;
        DB::enableQueryLog();
        // $cp = DB::table('corporates')->where('id', $id)->get();
        // $brokers = DB::table('brokers')->where('CP_ID_FK', $id)->get();
        if($status=='UN'){
            $policies = DB::select('
                SELECT corporates.name as CP_NAME,
                B.client_no, B.client_name, B.phone,
                B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
                FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
                from policies group by client_name, phone, draft_no ) A
                INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
                INNER JOIN corporates ON B.cust_id =corporates.id
                where B.cust_id='.$id.' and B.status=""');
        }
        else {
            $policies = DB::select('
                SELECT corporates.name as CP_NAME,
                B.client_no, B.client_name, B.phone,
                B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
                FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
                from policies group by client_name, phone, draft_no ) A
                INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
                INNER JOIN corporates ON B.cust_id =corporates.id
                where B.cust_id='.$id.' and B.status="'.$status.'"');
        }

         //dd(DB::getQueryLog());
        //$corp = DB::table('corporates')->get();
        return view('corporates.getstatus')->with('policies',$policies)->with('status', $status);
    }

    public function addComment(Request $request, $id){
        $str = explode('_', $id);
        $corp=$str[0];
        $draft=$str[1];
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
        $phone=$str[2];
        $comment_id = DB::table('comments')->insertGetId([
            'writer' => Auth()->user()->name,
            'phone' => $phone,
            'corporate_id' =>$corp,
            'draft_no' =>$draft,
            'message' => $request->comment
        ]);
        DB::table('notifications_admin')->insert([
            'title' => 'New Comment has been Added',
            'type' => 'normal',
            'to_' => '',
            'from_' => $id = Auth::user()->id,
            'body' => 'New comment on a client has been added, click for more info',
            'href' => URL_.'admin/'.$id.'/comments'
        ]);
        return back()->with('success', 'Reply has been addedd successfuly');
    }

    public function insertReply(Request $request){
        $name = Auth::user()->name;
        $id = Auth::user()->id;
        DB::table('replies')->insert([
           'comment_id' => $request->comment_id,
           'from_' => $name,
            'reply' => $request->message
        ]);
        $comment = DB::table('comments')->where('id', $request->comment_id)->get();
        DB::table('notifications_admin')->insert([
            'title' => 'New reply from the '.$name,
            'type' => 'normal',
            'to_' => '',
            'from_' => $id,
            'body' => 'New reply from '. $name.' has been added, click for more info',
            'href' => URL_.'admin/'.$comment[0]->policy_id.'/comments'
        ]);

        return back()->with('success', 'Reply has been addedd successfuly');
    }

    public function getRequests(){
        $req =
            DB::table('policy_requests')
                ->join('corporates', 'policy_requests.CP_ID_FK', 'corporates.id')
                ->join('users', 'policy_requests.USER_ID_FK', 'users.id')
            ->select('policy_requests.*', 'corporates.name as CP_NAME', 'corporates.email as CP_EMAIL','users.name as US_NAME', 'users.phone as USPHONE')
            ->where('CP_ID_FK', Auth()->user()->id)
            ->where('status', 'SENT_CP')->get();

        return view('corporates.requests')->with('req', $req);
    }

    public function policyConfirm($id){

        $req=DB::table('policy_requests')->where('id', $id)->get();
        DB::table('policy_requests')->where('id', $id)->update([
            'status' => 'DONE'
        ]);
        //admin notification
        DB::table('notifications_admin')->insert([
            'title' => 'Policy Confirmation',
            'type' => 'normal',
            'to_' => '',
            'from_' => Auth::user()->id,
            'body' =>  'Corporate '.Auth()->user()->name. ' has confirmed the policy',
            'href' => URL_.'admin/'
        ]);
        ////client notification
        DB::table('notifications_us')->insert([
            'title' => 'Your Policy Has been Confirmed',
            'type' => 'normal',
            'to_' => $req[0]->USER_ID_FK,
            'from_' => Auth::user()->id,
            'body' => 'Your Policy Has been Confirmed',
            'href' =>URL_.'/home'
        ]);
        return back()->with('success', 'Your Request has been confirmed and sent to Admin ');
    }

    public function policyDecline($id){

        $req=DB::table('policy_requests')->where('id', $id)->get();
        DB::table('policy_requests')->where('id', $id)->update([
            'status' => 'DECLINE'
        ]);
        DB::table('notifications_admin')->insert([
            'title' => 'Policy Declined',
            'type' => 'normal',
            'to_' => '',
            'from_' => Auth::user()->id,
            'body' =>  'Corporate '.Auth()->user()->name. ' has declined the policy',
            'href' => URL_.'admin/'
        ]);
        DB::table('notifications_us')->insert([
            'title' => 'Your Policy Has been declined',
            'type' => 'normal',
            'to_' => $req[0]->USER_ID_FK,
            'from_' => Auth::user()->id,
            'body' => 'Your Policy Has been declined, please contact the admin',
            'href' => URL_.'/home'
        ]);
        return back()->with('error', 'Policy has been declined and sent to Admin ');
    }

    public function getProfile(){
        $id= Auth()->user()->id;
        $profile =DB::table('corporates')
            ->where('id', $id)
            ->get();
        return view('corporates.profile')->with('profile',$profile);
    }

    public function updateProfile(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'email' => 'required',
            'phone' => 'required',
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
            $address= $request->input('address');
            DB::table('corporates')->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'photo' => $nameimg,
            ]);
        }
        else {
            $name= $request->input('name');
            $email= $request->input('email');
            $phone= $request->input('phone');
            $address= $request->input('address');
            DB::table('corporates')->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            ]);
        }
        return redirect('./corporate/profile')->with('success', 'Your profile has been updated !');
    }
    

    //reports

    public function reports(){
        $id= Auth()->user()->id;
        $paid = DB::select(' SELECT corporates.name as CP_NAME, count(B.id) as P_COUNT 
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at 
        from policies group by client_name, phone, draft_no ) A INNER JOIN policies B 
        USING (client_name, phone, draft_no,created_at) 
        INNER JOIN corporates ON B.cust_id =corporates.id 
        where
        MONTH(B.created_at) = 5
        AND YEAR(B.created_at) = YEAR(NOW())
        and B.status = "P" and B.cust_id='.$id.' GROUP BY month(B.created_at)');

        $paid_online = DB::select('  SELECT corporates.name as CP_NAME, count(B.id) as P_COUNT 
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at 
        from policies group by client_name, phone, draft_no ) A INNER JOIN policies B 
        USING (client_name, phone, draft_no,created_at) 
        INNER JOIN corporates ON B.cust_id =corporates.id 
        where
        MONTH(B.created_at) = 5
        AND YEAR(B.created_at) = YEAR(NOW())
        and B.status = "P-online" and B.cust_id='.$id.' GROUP BY month(B.created_at)');

        return view('corporates.reports.index')->with('paid',$paid)->with('paid_online',$paid_online);
    }

    public function advanced(){
        $id= Auth()->user()->id;
        $corp =DB::table('corporates')->get();

        return view('corporates.reports.advanced')->with('corp', $corp);
    }
    public function search1(Request $request){
       // $d =str_replace('!', '/', $request->input('dates'));
        echo $request->input('dates');
        $where=' where ';
        
        if($request->input('dates') !=0){
            $dates =explode(' - ', $request->input('dates'));
            
            $start    = (new DateTime($dates[0]))->modify('first day of this month');
            $end      = (new DateTime($dates[1]))->modify('first day of next month');
            $interval = DateInterval::createFromDateString('1 month');
            $period   = new DatePeriod($start, $interval, $end);

            foreach ($period as $dt) {
                echo $dt->format("m") . "<br>\n";
            }
        }
    }

    public function search(Request $request){
        $id= Auth()->user()->id;
        $d = $request->input('dates');
        $corp = $request->input('corp');
        $dateype = $request->input('dateype');
        $where=' where ';
        //if($corp !='null') {
            $where.= ' B.cust_id='.$id.'  AND ';
      //  }
               
        if($d !=0){
            $dates =explode(' - ', $d);
            $s = strtotime($dates[0]);
            $e = strtotime($dates[1]);
            $sdate =date('Y-m-d',$s);
            $edate =date('Y-m-d',$e);
           // echo $sdate;
            $where.=" (B.".$dateype." BETWEEN '".$sdate."' AND '".$edate."') AND ";
           
        }

        $where = substr($where, 0, -4);

        DB::enableQueryLog();
        $data = DB::select(' SELECT B.status as STAT, month(B.created_at) as MONTHS, count(B.id) as P_COUNT
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at 
        from policies group by client_name, phone, draft_no ) A INNER JOIN policies B 
        USING (client_name, phone, draft_no,created_at) 
        '.$where.' group by B.status, month(B.created_at)');
        //dd(DB::getQueryLog());
       $status =[];
       $dataArray =[];
       $datArray =[];
        foreach($data as $d){
            array_push ( $status, $d->STAT );
            array_push ( $dataArray, $d->P_COUNT );
            array_push ( $datArray, $d->MONTHS );
        }
        for($i = 0; $i < count ( $dataArray ); $i ++) {
            if($status[$i]==""){
                $status[$i]="UN";
            }
            else {
                $status[$i]=$status[$i];
            }
            $chartArray ["series"] [] = array (
                    "name" => $status[$i],
                    "data" => "[".$dataArray [$i]."]" 
            );
        }
        $chartArray ["chart"] = array (
            "type" => "column" 
        );
        $chartArray ["title"] = array (
                "text" => "Yearly sales" 
        );
        $chartArray ["credits"] = array (
                "enabled" => false 
        );
        $chartArray ["xAxis"] = array (
                "categories" => array () 
        );
        $chartArray ["tooltip"] = array (
                "valueSuffix" => "$" 
        );


        $chartArray ["yAxis"] = array (
                "title" => array (
                "text" => "Sales ( $ )" 
                ) 
    );
    return view ( 'corporates.reports.data' )->withChartarray ( $chartArray );
        
    }


}
