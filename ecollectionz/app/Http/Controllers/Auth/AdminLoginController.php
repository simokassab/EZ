<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
      return view('auth.admin-login');
    }

    public function login(Request $request)
    {
      // validate form data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      //Attempt to log the user in
      if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'active' => 1],  $request->remember)) {
                return redirect()->route('admin.dashboard');
            }
            //if ok, redirect to location
      else {
        return back()->withErrors(array('message' => 'Login Error, Please try again'));
      }
      //else then redirect to login with form data
    
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success', 'Logged Out');
    }
}
