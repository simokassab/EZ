<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class AdminBrokersController extends Controller
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
        $brokers = DB::table('brokers')
                   ->join('corporates', 'brokers.CP_ID_FK', '=', 'corporates.id')
                   ->select('corporates.name as CP_NAME', 'corporates.pay_online as CP_PAY', 'brokers.*')
                   ->get();
        return view('adm.brokers.index')->with('brokers', $brokers)->with('corp', $corp);
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
         DB::table('brokers')->insert([
            'bk_id' => $request->input('bk_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'CP_ID_FK' => $request->input('corporates'),
            'password' => Hash::make($request->input('password')), 
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'photo' => $nameimg
         ]);
        $this->name =$request->input('name');
        $this->email =$request->input('email');
        $this->password =$request->input('password');
       /* Mail::send([],[], function ($message) {
        $message->from('mohammad.kassab@mediaworldiq.com', 'M KASSAB');
        $message->sender('mohammad.kassab@mediaworldiq.com', 'mohammad.kassab@mediqworldiq.com');
        $message->to( $this->email, $this->name);
        $message->subject('EcollectZ New Corporate User');
        $message->setBody('<h1>Hi, '.$this->name.'</h1><br/>
                        <p><i>Your Account has been successfully created, please find your credentials Below:</i></p><br/>
                        <ul>
                            <li>Email: '. $this->email.'</li>
                            <li>Password: '.$this->password.'</li></ul>
                        <h5>You can Sign in here: http://ecollectz.online/corporate    </h5><br/><br/>
                        <h2>Ecollect Team</h2><br/><br/>
                        <h6>Kindly, Do not reply to this email</h6>', 'text/html');
        });*/
         //dd(DB::getQueryLog());
         return back()->with('success', "Broker ".$request->input('name')." has been created successfully");
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
        $corp = DB::table('corporates')->get();
        $brokers = DB::table('brokers')
                   ->join('corporates', 'brokers.CP_ID_FK', '=', 'corporates.id')
                   ->select('corporates.name as CP_NAME','corporates.id as CP_ID', 'corporates.pay_online as CP_PAY', 'brokers.*')
                   ->where('brokers.id',$id)->get();
        return view('adm.brokers.edit')->with('corp',$corp)->with('brokers', $brokers);
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
            'bk_id' =>'required',
            'name' =>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'corporates' => 'required'
        ]);
        $file = $request->file('photo');
        if ($file !=''){
            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            $nameimg = $file->getClientOriginalName();
            $file->move(public_path('images'), $nameimg);
            DB::table('brokers')
                ->where('id', $id)
                ->update([
                    'bk_id' =>  $request->input('bk_id'),
                    'name' =>  $request->input('name'),
                    'email' => $request->input('email'),
                    'CP_ID_FK' => $request->input('corporates'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone'),
                    'photo' =>  $nameimg
                ]);
        }
        else {
            DB::table('brokers')
                ->where('id', $id)
                ->update([
                    'bk_id' =>  $request->input('bk_id'),
                    'name' =>  $request->input('name'),
                    'email' => $request->input('email'),
                     'CP_ID_FK' => $request->input('corporates'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone')
                ]);
        }
       // $corp = DB::table('corporates')->get();
        return redirect('/admin/brokers')->with('success', "Broker ".$request->input('name')." has been  successfully");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('brokers')->where('id', $id)->update(['active' => 0]);
        //$corp = DB::table('corporates')->get();
         return redirect('/admin/brokers')->with('error', "Broker has been  desactivated");
    }

    public function activate($id)
    {
        DB::table('brokers')->where('id', $id)->update(['active' => 1]);
        //$corp = DB::table('corporates')->get();
         return redirect('/admin/brokers')->with('success', "Broker has been  activated");
    }

    
}
