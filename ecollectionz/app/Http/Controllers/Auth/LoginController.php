<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:web', ['except' => ['logout']]);
    }
     public function showLoginForm()
    {
      return view('auth.login');
    }
    public function login(Request $request)
    {
      // validate form data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      //Attempt to log the user in
      if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'verify' => 1],  $request->remember)) {
                return redirect()->route('home');
            }
            //if ok, redirect to location
      else {
        return back()->withErrors(array('message' => 'Login Error, Check your credentials'));
      }
      //else then redirect to login with form data
    
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login')->with('success', 'Logged Out');
    }
}
