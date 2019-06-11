<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getNotifications(){
        $dt = Carbon::now();
        DB::enableQueryLog();
        $unread = DB::table('notifications_admin')->select(DB::raw('COUNT(id) as COUNT'), 'notifications_admin.*')
            ->where('isread', '=', '0')
            ->where(DB::raw('DATE(scheduled)'), '<=', $dt->toDateString())
            ->groupBy('id')->orderBy('scheduled', 'DESC')->get()->toArray();
       // dd(DB::getQueryLog());
        echo json_encode($unread);

    }

    public function marAsRead($id){
        DB::table('notifications_admin')->where('id', $id)->update(['isread' => 1]);
        $not_url = DB::table('notifications_admin')->where('id', '=', $id)->get();
        echo $not_url[0]->href;
    }

}



