<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class UserNotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getNotifications(){
        $id=auth()->user()->id;
        $dt = Carbon::now();
        DB::enableQueryLog();
        $unread = DB::table('notifications_us')->where('isread', '=', '0')
             ->where('to_', $id)
            ->where(DB::raw('DATE(scheduled)'), '=', $dt->toDateString())
            ->orWhere(DB::raw('DATE(scheduled)'), '<', $dt->toDateString())
            ->groupBy('id')->orderBy('scheduled', 'DESC')->get()->toArray();
        echo json_encode($unread);

    }

    public function marAsRead($id){
        DB::table('notifications_us')->where('id', $id)->update(['isread' => 1]);
        $not_url = DB::table('notifications_us')->where('id', '=', $id)->get();

        echo $not_url[0]->href;
    }

    public function getCount(){

    }
}
