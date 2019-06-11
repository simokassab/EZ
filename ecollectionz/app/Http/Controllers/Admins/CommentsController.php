<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function getComments($id){

        DB::enableQueryLog();
        $str = explode('_', $id);
        $corp=$str[0];
        $draft=$str[1];
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
        $phone=$str[2];
        $policies = DB::table('policies')
        ->where('cust_id', $corp)
        ->where('draft_no', $draft)
        ->where('phone', $phone)
            ->get();

        $comments = DB::table('comments')
        ->join('corporates', 'comments.corporate_id', 'corporates.id')
                ->where('corporate_id', $corp)
                ->where('draft_no', $draft)
                ->where('comments.phone', $phone)
            ->select('comments.*', 'corporates.*', 'comments.id as CID')
            ->get();
        $replies = DB::table('comments')->leftJoin('replies', 'comments.id', '=', 'replies.comment_id')
            ->where('corporate_id', $corp)
            ->where('draft_no', $draft)
            ->where('comments.phone', $phone)
            ->get();
       // dd(DB::getQueryLog());
        return view('adm.comments')
        ->with('comments', $comments)->
        with('replies', $replies)->
        with('policies', $policies);
    }


    public function addComment(Request $request, $id){
        $str = explode('_', $id);
        $corp=$str[0];
        $draft=$str[1];
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
        $phone=$str[2];
        $policy =DB::select('SELECT B.cust_id,
        B.client_no, B.client_name, B.phone, B.cust_id,
        B.draft_no, B.phone
        FROM ( select client_name, phone, draft_no, status, max(created_at) as created_at
        from policies group by client_name, phone, draft_no ) A
        INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
        INNER JOIN corporates ON B.cust_id =corporates.id 
        where B.cust_id='.$corp.' and B.draft_no="'.$draft.'" and B.phone='.$phone);
        $comment_id = DB::table('comments')->insertGetId([
            'writer' => Auth()->user()->name,
            'phone' => $phone,
            'corporate_id' =>$corp,
            'draft_no' =>$draft,
            'message' => $request->comment
        ]);
        DB::table('notifications_cp')->insert([
            'title' => 'New Comment has been Added',
            'type' => 'normal',
            'to_' => $policy[0]->cust_id,
            'from_' => Auth::user()->id,
            'body' => 'New comment on a client has been added, click for more info',
            'href' => URL_.'corporate/'.$id.'/comments'
        ]);

        return back()->with('success', 'Reply has been addedd successfuly');
    }

    public function insertReply(Request $request){
        $name = Auth::user()->name;
        $id='';
        DB::table('replies')->insert([
            'comment_id' => $request->comment_id,
            'from_' => $name,
            'reply' => $request->message
        ]);
        $comment = DB::table('comments')->where('id', $request->comment_id)->get();
        $draft=$comment[0]->draft_no;
        $draft=str_replace('-', '/', $draft);
        $draft=str_replace('!', '\\', $draft);
            DB::table('notifications_cp')->insert([
                'title' => 'New reply from the Admin',
                'type' => 'normal',
                'to_' => $comment[0]->corporate_id,
                'from_' => $id = Auth::user()->id,
                'body' => 'New reply from the admin has been added, click for more info',
                'href' => URL_.'corporate/'.$comment[0]->corporate_id.'_'.$draft.'+'.$comment[0]->phone.'/comments'
            ]);
        return back()->with('success', 'Reply has been addedd successfuly');
    }
}
