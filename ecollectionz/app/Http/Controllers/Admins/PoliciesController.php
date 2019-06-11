<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\policies;
use DB;
use Excel;

class PoliciesController extends Controller
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

        return view('adm.policies')->with('corp', $corp);
    }

    public function getDatatable($cust){
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
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

    public function getHistory($id){
        $str = explode('_', $id);
        $phone=$str[0];
        $draft=$str[1];
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
        $name=$str[2];
        $history = DB::table('policies')
            ->join('corporates', 'policies.cust_id', 'corporates.id')
            ->where('client_name', $name)
            ->where('policies.phone', $phone)
            ->where('draft_no', $draft)
            ->select('policies.*', 'corporates.name as CP_NAME')
            ->get();
        return view('adm.history')->with('history', $history);
    }
    public function getPoliciesByClient ($phone){
        DB::enableQueryLog();
        $policies = DB::table('policies')
            ->where('phone', '=', $phone)
            ->get();
        $policies = DB::select('
        SELECT corporates.name as CP_NAME,
        B.client_no, B.client_name, B.phone, B.cust_id,
        B.draft_no, B.due_date, B.status, B.currency, B.amount, B.remarks as RK, B.created_at
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id
        where B.phone='.$phone);
        return view('adm.policy')->with('policies', $policies);

    }


}
