<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;

class SupervisorLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:supervisor', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
      return view('auth.supervisor-login');
    }

    public function login(Request $request)
    {
      // validate form data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      //Attempt to log the user in
      if (Auth::guard('supervisor')
      ->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if ok, redirect to location
            return redirect()->intended(route('supervisor.dashboard'));
      }
      //else then redirect to login with form data
      return Redirect::back()->with('error', 'Login Error');
    }

    public function logout()
    {
        Auth::guard('supervisor')->logout();
        return redirect('/supervisor/login')->with('success', 'Logged Out');
    }
}
