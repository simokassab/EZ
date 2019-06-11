<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\policies;
use DB;
use Excel;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->user =  \Auth::user();
    
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        DB::enableQueryLog();

            $nb_corp = DB::table('corporates')->select(DB::raw('COUNT(*) as CP_COUNT'))->get();
        //registered users having policieswhereIn('id', function($query){
        $us_reg_pol =DB::table('users')->select(DB::raw('COUNT(users.id) as US_REG_POL_COUNT'))
            ->whereIn('phone', function($query)
            {
                $query->select('phone')
                    ->from('policies');
            })
            ->get();
        
        //unregistered users having policies
        $us_unreg_pol = DB::table('policies')

            ->whereNotIn('phone',function($query){
                $query->select('phone')->from('users');
            })
            ->count(DB::raw('DISTINCT phone'));
        //registered users not having policies
        $us_reg_unpol = DB::table('users')
            ->whereNotIn('phone',function($query){
                $query->select('phone')->from('policies');
            })
            ->count(DB::raw('DISTINCT phone'));
        // status summary for alla clients
       // dd(DB::getQueryLog());
   
        $summary =  DB::select('SELECT count(B.id)as COUNT, B.status  FROM ( select client_name, phone, draft_no, 
        status, max(created_at) as created_at from policies group by client_name, phone, draft_no ) A 
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id  GROUP BY B.status');
       // auth()->user()->notify(new GeneralNotification());
        return view('admin')->with('summary', $summary)
            ->with('nb_corp', $nb_corp)
            ->with('us_reg_pol', $us_reg_pol)
            ->with('us_unreg_pol', $us_unreg_pol)
            ->with('us_reg_unpol', $us_reg_unpol)
            ;
    }

    public function getPoli()
    {
            $clients =DB::table('users')
                ->whereIn('phone', function($query)
                {
                    $query->select('phone')
                        ->from('policies');
                })
                ->get();
        return view('adm.poli')->with('clients',$clients);
    }

    public function getPoli1(){
            $clients1 = DB::table('policies')->select(DB::raw('DISTINCT phone'), 'client_name')
                ->whereNotIn('phone',function($query){
                    $query->select('phone')->from('users');
                })
                ->get();
        return view('adm.poli1')->with('clients1',$clients1);
    }

    public function getPoli2(){
        $clients2 =DB::table('users')
            ->whereNotIn('phone', function($query)
            {
                $query->select('phone')
                    ->from('policies');
            })
            ->get();
        return view('adm.poli2')->with('clients2',$clients2);
    }

    public function getProfile(){
        $id= Auth()->user()->id;
        $profile =DB::table('admins')
            ->where('id', $id)
            ->get();
        return view('adm.profile')->with('profile',$profile);
    }

    public function updateProfile(Request $request){
        $id= Auth()->user()->id;
       $name= $request->input('name');
       $email= $request->input('email');
       $phone= $request->input('phone');
       DB::table('admins')->where('id', $id)
       ->update([
           'name' => $name,
           'email' => $email,
           'phone' => $phone
       ]);
        return redirect('./admin/profile')->with('success', 'Your profile has been updated !');
    }

    
}
