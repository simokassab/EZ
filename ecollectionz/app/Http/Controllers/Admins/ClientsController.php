<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\policies;
use DB;
use Excel;

class ClientsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        DB::enableQueryLog();
       // SELECT SUM(value)/COUNT(value) FROM gpa where value <> -1 and US_PHONE=96171717787
        $clients = DB::table('policies')
            ->leftJoin('gpa', 'policies.phone', '=', 'gpa.US_PHONE')
            ->select(DB::raw('DISTINCT(policies.client_name) as CNAME'), 
            DB::raw('ROUND(SUM(value)/COUNT(value),1) as GPAA'), 'policies.phone as PPHONE',
                'policies.created_at as CDATE', 'policies.address as ADDR', 'client_name', 'client_no', 'client_id',
                'policies.address as ADDR', 'policy'

            )
            ->groupBy('policies.client_name')->get();
       // dd(DB::getQueryLog());
        return view('adm.unrclients')->with('clients', $clients);
    }

    function getUsers(){
        DB::enableQueryLog();
        $clients =DB::table('users')
            ->leftJoin('policies', 'policies.phone', '=', 'users.phone')
            ->leftJoin('gpa', 'users.phone', '=', 'gpa.US_PHONE')
            ->select(DB::raw('DISTINCT(users.phone) as PPHONE'), 'users.name as CNAME', 'client_no', 'client_id',
                'policies.address as ADDR', 'policy', 'users.email as EMAILS', 'users.id as ID_',
                'gpa.value as GPAA'
            )
            ->get();
       // dd(DB::getQueryLog());
        return view('adm.rclients')->with('clients', $clients);
    }
}
