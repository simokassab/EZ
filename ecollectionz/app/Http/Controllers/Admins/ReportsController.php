<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function reports(){

        $paid = DB::select(' SELECT corporates.name as CP_NAME, count(B.id) as P_COUNT 
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at 
        from policies group by client_name, phone, draft_no ) A INNER JOIN policies B 
        USING (client_name, phone, draft_no,created_at) 
        INNER JOIN corporates ON B.cust_id =corporates.id 
        where
        MONTH(B.created_at) = MONTH(CURRENT_DATE())
        AND YEAR(B.created_at) = YEAR(NOW())
        and B.status = "P" group by CP_NAME, month(B.created_at)');

        $paid_online = DB::select('  SELECT corporates.name as CP_NAME, count(B.id) as P_COUNT 
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at 
        from policies group by client_name, phone, draft_no ) A INNER JOIN policies B 
        USING (client_name, phone, draft_no,created_at) 
        INNER JOIN corporates ON B.cust_id =corporates.id 
        where
        MONTH(B.created_at) = MONTH(CURRENT_DATE())
        AND YEAR(B.created_at) = YEAR(NOW())
        and B.status = "P-online" group by CP_NAME, month(B.created_at)');

        return view('adm.reports.index')->with('paid',$paid)->with('paid_online',$paid_online);
    }

    public function advanced(){
        $corp =DB::table('corporates')->get();
        $data='EMPTY';
        return view('adm.reports.advanced')->with('data', $data)->with('corp', $corp);
    }
    public function search(Request $request){
        $corp =DB::table('corporates')->get();
        $corp1 = $request->input('corp');
        $d = $request->input('dates');
        $status = $request->input('status');
        $datetype = $request->input('datetype');
        $where=' where B.cust_id='.$corp1. ' AND ';
        if($d !=0){
            $dates =explode(' - ', $d);
            
            $s = strtotime($dates[0]);
            $e = strtotime($dates[1]);
            $sdate =date('Y-m-d',$s);
            $edate =date('Y-m-d',$e);
           // echo $sdate;
            $where.=" (B.".$datetype." BETWEEN '".$sdate."' AND '".$edate."') AND ";
           
        }
        if($status !='0'){
            if ($status=='UN'){
                
                $where.=" B.status ='' AND ";
            }
            else {
                $where.=" B.status ='".$status."' AND ";
            }
            // $where.=" and  ( status='$status' )";
           
        }
        $where = substr($where, 0, -4);

        DB::enableQueryLog();
        $data = DB::select(' SELECT corporates.name as CP_NAME, month(B.'.$datetype.') as MNTH, count(B.id) as P_COUNT
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at 
        from policies group by client_name, phone, draft_no ) A INNER JOIN policies B 
        USING (client_name, phone, draft_no,created_at) 
        INNER JOIN corporates ON B.cust_id =corporates.id '.$where.' group by month(B.'.$datetype.')');
        //dd(DB::getQueryLog());

        if(empty($data)){
            $data="EMPTY";
        }
        else {
            return view('adm.reports.advanced')->with('data', $data)->with('corp', $corp);
        }
    }
}
