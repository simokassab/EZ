<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;

class BrokersLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:brokers', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
      return view('auth.brokers-login');
    }

    public function login(Request $request)
    {
      // validate form data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      //Attempt to log the user in
      if (Auth::guard('brokers')
      ->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if ok, redirect to location
            return redirect()->intended(route('brokers.dashboard'));
      }
      //else then redirect to login with form data
      return Redirect::back()->with('error', 'Login Error');
    }

    public function logout()
    {
        Auth::guard('brokers')->logout();
        return redirect('/brokers/login')->with('success', 'Logged Out');
    }
}
