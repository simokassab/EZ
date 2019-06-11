<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailRegistration;

class VerifyController extends Controller
{
    public $email ='';
    public $name ='';
    public $password ='';
    
    public function getVerify(){
        return view('verify');
    }

    public function postVerify(Request $request){
        if($user = User::where('code', $request->code)->first()){
            $user->verify =1;
            $user->code = null;
            $user->save();
            if($user->verify==1){
                Mail::to($user->email)->send(new SendEmailRegistration($user));
                return redirect()->route('home')->with('success', 'You are successfully registred !');

            }
            else {
                return redirect()->route('register')->with('error', 'Not Registred, <br><br> please contact the support !');
            }
            
        }
        else {
            return back()->withMessage('not correct');
        }
    }

    public function resendCode($phone) {
        User::where('phone', $phone)
          ->update([
              'code' => SendCode::sendCode($phone)

          ]);
       // $user->code = SendCode::sendCode($user->phone);
       return redirect()->back()->with('success', 'Code has been sent again');  
    }
}
