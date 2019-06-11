<?php

namespace App\Http\Controllers\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Session;
use DateTime;
use PDF;
use File;
use Response;


class AdvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        return view('adm.adv');
    }

    public function saveIt(Request $request){
        $this->validate($request,[
            'slider' =>'required',
            'title' =>'required',
            'desc' => 'required',
            'url' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ]);
        $file = $request->file('photo');
        $slider = $request->input('slider');
        $file->move(public_path()."/images/slider_".$slider, 'img.png' );
       // echo public_path()."/images/slider_".$slider."/img.png";
       echo $request->input('url');
        DB::table('adv')
        ->where('id', $slider)
        ->update([
            'title' =>  $request->input('title'),
            'description' => $request->input('desc'),
            'url' => $request->input('url'),
            'photo' =>  public_path()."/images/slider_".$slider."/img.png"
        ]);

        return view('adm.adv')->with('success', 'Slider '.$slider.'Has been uploaded successfully');
    }
}
