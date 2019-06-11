<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class PRequestsController extends Controller
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
        $req=DB::table('policy_requests')
            ->join('corporates', 'policy_requests.CP_ID_FK', 'corporates.id')
            ->join('users', 'policy_requests.USER_ID_FK', 'users.id')
            ->select('policy_requests.*', 'corporates.name as CP_NAME', 'corporates.email as CP_EMAIL', 'users.name as US_NAME', 'users.phone as USPHONE')
            ->where('status', 'PENDING')->orderBy('created_at', 'DESC')->get();
        $req_sent=DB::table('policy_requests')
            ->join('corporates', 'policy_requests.CP_ID_FK', 'corporates.id')
            ->join('users', 'policy_requests.USER_ID_FK', 'users.id')
            ->select('policy_requests.*', 'corporates.name as CP_NAME', 'corporates.email as CP_EMAIL', 'users.name as US_NAME', 'users.phone as USPHONE')
            ->where('status', 'SENT_CP')->orderBy('created_at', 'DESC')->get();
        $req_done=DB::table('policy_requests')
            ->join('corporates', 'policy_requests.CP_ID_FK', 'corporates.id')
            ->join('users', 'policy_requests.USER_ID_FK', 'users.id')
            ->select('policy_requests.*', 'corporates.name as CP_NAME', 'corporates.email as CP_EMAIL', 'users.name as US_NAME', 'users.phone as USPHONE')
            ->where('status', 'DONE')->orderBy('created_at', 'DESC')->get();
        $req_decline=DB::table('policy_requests')
            ->join('corporates', 'policy_requests.CP_ID_FK', 'corporates.id')
            ->join('users', 'policy_requests.USER_ID_FK', 'users.id')
            ->select('policy_requests.*', 'corporates.name as CP_NAME', 'corporates.email as CP_EMAIL', 'users.name as US_NAME', 'users.phone as USPHONE')
            ->where('status', 'DECLINED')->orderBy('created_at', 'DESC')->get();

        return view('adm.p_requests')->with('req', $req)->with('req_sent', $req_sent)
            ->with('req_done', $req_done)->with('req_decline', $req_decline);
    }

    public function sendToCp($id){

        $req=DB::table('policy_requests')->join('corporates', 'policy_requests.CP_ID_FK', 'corporates.id')
            ->where('policy_requests.id', $id)->get();
        $this->email = $req[0]->email;
        DB::table('policy_requests')->where('id', $id)->update([
            'status' => 'SENT_CP'
        ]);
        DB::table('notifications_cp')->insert([
            'title' => 'New Policy Request from Admin',
            'type' => 'normal',
            'to_' => $req[0]->CP_ID_FK,
            'from_' => Auth::user()->id,
            'body' => 'New Policy Request from Admin, Click for more info',
            'href' => URL_.'corporate/requests'
        ]);

        Mail::send([],[], function ($message) {
            $message->from(Auth()->user()->email, Auth()->user()->name);
            $message->sender(Auth()->user()->email, Auth()->user()->email);
            $message->to($this->email);
            $message->subject('New Policy Request from Admin');
            $message->setBody('<h1>Hi,</h1><br/>
                            <p><i>New Policy Request from Admin, Click on the link below for more info:</i></p><br/>
                            
                            <h5>'.URL_.'/corporate/requests/</h5><br/><br/>
                            <h2>Ecollect Team</h2><br/><br/>
                            <h6>Kindly, Do not reply to this email</h6>', 'text/html');
        });

        return back()->with('success', 'Your Request has been sent to the Corporate ');
    }

    public function policyConfirm($id){

        $req=DB::table('policy_requests')->where('id', $id)->get();
        DB::table('policy_requests')->where('id', $id)->update([
            'status' => 'DONE'
        ]);
        DB::table('notifications_us')->insert([
            'title' => 'Your Policy Has been Confirmed',
            'type' => 'normal',
            'to_' => $req[0]->USER_ID_FK,
            'from_' => Auth::user()->id,
            'body' => 'Your Policy Has been Confirmed',
            'href' => URL_.'/home'
        ]);
        return back()->with('success', 'Policy has been confirmed ans sent to client ');
    }

    public function policyDecline($id){

        $req=DB::table('policy_requests')->where('id', $id)->get();
        DB::table('policy_requests')->where('id', $id)->update([
            'status' => 'DECLINE'
        ]);
        DB::table('notifications_us')->insert([
            'title' => 'Your Policy Has been declined',
            'type' => 'normal',
            'to_' => $req[0]->CP_ID_FK,
            'from_' => Auth::user()->id,
            'body' => 'Your Policy Has been declined, please contact the admin',
            'href' => URL_.'/home'
        ]);
        return back()->with('error', 'Policy has been declined ans sent to client ');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
