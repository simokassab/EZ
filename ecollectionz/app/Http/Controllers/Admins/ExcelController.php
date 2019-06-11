<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\policies;
use App\err_policies;
use DB;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DateTime;


class ExcelController extends Controller
{
    public $check = 0;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function excelView(){
        $corp = DB::table('corporates')->get();
       // $admin =  auth()->user();
       // auth()->user()->notify(new NotifyExcel($admin));
        return view('adm.excel')->with('corp', $corp);
    }

    public function importExcel(Request $request)
    {
        set_time_limit(0);
        date_default_timezone_set('Asia/Beirut');
        DB::enableQueryLog();
        $request->validate([
            'import_file' => 'required'
        ]);
        $insert_data = array();
        $request->file('import_file')->move(storage_path() . '/imports/', 'import.xlsx');  
            Excel::load(storage_path('/imports/import.xlsx'), function ($reader) {
            foreach ($reader->toArray() as $key => $row) {
                $bdate = strtotime($row['date']);
                $borddate =date('Y-m-d',$bdate);
                $ddate = strtotime($row['duedate']);
                $duedate =date('Y-m-d',$ddate);
                $row['phone'] = str_replace('.', '', $row['phone'] );

              if( (strlen(trim($row['phone'])) != 0) && (strlen(trim($row['phone'])) > 9) 
              && ($row['phone']!='961') && (strlen(trim($row['phone'])) <12) ){
                  //echo " COND: ".$row['phone']." - SIZE ".strlen(trim($row['phone']))."<br>";
                    if($row['status']==''){
                        $stat ='';
                    }
                    else {
                        $stat = $row['status'];
                    }
                    if ($row['curno'] == 'USD') {
                        $c = 1;
                    } else {
                        $c = 0;
                    }
                    if ($row['status'] == 'P') {
                        $d = date('Y-m-d');
                    } else {
                        $d = '';
                    }
                    
                    $hash = md5($row['phone'] . $row['draftno'] . $duedate.$stat.$borddate.$row['amnt'].$row['remarks']);
                    $res = policies::where('hash', $hash)->exists();
                    if(!$res) {
                        $data = [
                        'cust_id'                   => $row['custno'],
                        'policy'                    => '',
                        'bord_date'                 => $borddate,
                        'client_id'                 => $row['custno'],
                        'client_no'                 => $row['clientno'],
                        'client_name'               => $row['clientname'],
                        'draft_no'                  => $row['draftno'],
                        'status'                    => $stat,
                        'due_date'                   => $duedate,
                        'currency'                   => $c,
                        'amount'                  => $row['amnt'],
                        'zone'                  => $row['zone'],
                        'broker_id'                  => $row['brokercode'],
                        'broker_name'                  => $row['brokername'],
                        'remarks'                  => $row['remarks'],
                        'phone'                  => $row['phone'],
                        'insured_name'                  => $row['insname'],
                        'address'                  => '' ,        
                        'hash'                  => $hash         
                        ];
                    $insert_data[] = $data;
                  }
                  /*else { 
                    $mytime = new Carbon();
                          DB::table('policies')
                              ->where('phone', '=', $row['phone'])
                              ->where('draft_no', '=', $row['draftno'])
                              ->where('due_date', '=', $duedate)
                              ->where('status', '=', $stat)
                              ->where('bord_date', '=', $borddate)
                              ->where('cust_id', '=', $row['custno'])
                              ->where('amount', '=', $row['amnt'])
                              ->where('remarks', '=', $row['remarks'])
                              ->update([
                                  'created_at' => $mytime->toDateTimeString()]);
                      }*/
              }
            } //end foreach
            if(!empty($insert_data)){
                $insert_data = collect($insert_data);
                $chunks = $insert_data->chunk(500);  
                foreach ($chunks as $chunk)
                {
                    DB::table('policies')->insert($chunk->toArray());
                    
                } 
            }
            
                    DB::table('notifications_admin')->insert([
                        'title' => 'Excel imported',
                        'type' => 'normal',
                        'to_' => '',
                        'from_' => '',
                        'body' => 'Your excel has been imported, click here to see policies',
                        'href' => URL_.'admin/policies_',
                        'scheduled' => date('Y-m-d H:i:s')
                    ]);
           
            
        });    
       
    }

    public function downloadExcel (Request $request)
    {
        DB::enableQueryLog();
        $sdate ='';
        $edate = '';
        $s ='';
        $e = '';
        $where =" where id > 0 ";
       // return $request->input('dates');
        $d = $request->input('dates');
        $polic =policies::where('id', '>', 0);
        if($d !=''){
            $dates =explode(' - ', $d);
            $s = strtotime($dates[0]);
            $e = strtotime($dates[1]);
            $sdate =date('Y-m-d H:i:s',$s);
            $edate =date('Y-m-d H:i:s',$e);
           // $where.=" and  ( created_at between  '$sdate' and  '$edate' )";
            $polic->whereBetween('created_at', [$sdate, $edate]);
        }

        $cor = $request->input('corporates');
        if($cor !='null'){
          //  $where.=" and  ( cust_no='$cor' )";
            $polic->where('cust_id', '=', $cor);
        }

        $status = $request->input('status');
        if($status !='null'){
           // $where.=" and  ( status='$status' )";
            $polic->where('status', '=', $status);
        }
        $data = $polic->get()->toArray();
        dd(DB::getQueryLog());
        if(empty($data)){
            return back()->with('error', 'No Data with the selected query !');
        }
        //$data = DB::table('policies')->where

        return \Excel::create('Exported Data_'.date('Y-m-d'), function($excel) use ($data) {
            $excel->sheet('sheet name', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');

    }
}
