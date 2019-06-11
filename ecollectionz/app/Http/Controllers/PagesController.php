<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PagesController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function corporate (){
        return view('adm.corporate');
    }
    public function brokers (){
        return view('adm.brokers.index');
    }
    public function excelPage (){
        return view('adm.excel');
    }
    public function feedback (){
        return view('adm.feedback');
    }
    public function reports (){
        return view('reports.index');
    }
}
