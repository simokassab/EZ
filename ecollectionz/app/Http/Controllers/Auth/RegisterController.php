<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\SendCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller

{

    public $email ='';
    public $name ='';
    public $password ='';
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function register(Request $request)
    {
        
        $this->validate($request, [
         'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'unique:users',
            'city' => 'required',
            'country' => 'required',
        ]);
        echo $request->phone;
        $pho = DB::table('users')->where('phone', $request->input('phone'))->get();
        if($pho->isEmpty()){
            event(new Registered($user =$this->create($request->all())));
            return $this->registered($request, $user) ?: redirect('/verify?phone='.$request->phone);
        }
       
    }

    protected function create(array $data)
    {

        $this->email =$data['email'];
        $this->name =$data['name'];
        $this->password =$data['password'];
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'verify' => 0
        ]);
        DB::table('notifications_admin')->insert([
            'title' => 'New Client has been registred',
            'type' => 'normal',
            'to_' => '',
            'from_' => '',
            'body' => 'New Client Has been registred',
            'href' => URL_.'admin/rclients',
            'scheduled' => date('Y-m-d H:i:s')
        ]);
        if($user){
            $user->code = SendCode::sendCode($user->phone);
            $user->save();
            Auth::login($user);
        }
    }
}
