<?php

namespace App\Http\Controllers\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Excel;

class FeedbackController extends Controller
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
        DB::enableQueryLog();
       $feedback = DB::table('feedback')->orderBy('isread', 'ASC')->get();
       // dd(DB::getQueryLog());
        return view('adm.feedback')->with('feedback', $feedback);
    }

    public function markAsRead($id){

        DB::table('feedback')
            ->where('id', $id)
            ->update(['isread' =>  '1']);
       // $feedback = DB::table('feedback')->orderBy('isread', 'ASC')->get();
        return redirect('/admin/feedback')->with('success', "Feedback has been Marked as READ ");
    }


}
