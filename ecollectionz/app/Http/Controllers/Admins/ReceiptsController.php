<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use  Auth;
use Mail;
use Hash;
use Illuminate\Support\Facades\Session;
use PDF;
use DateTime;
use File;
use Response;

class ReceiptsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $policies = DB::table('policies')
            ->join('receipts', 'policies.id', 'receipts.POLICY_ID_FK')
            ->select('policies.*', 'receipts.id as RID', 'receipts.STAMP_ID_FK')
            ->where('status', 'P-online')->get();

        return view('adm.receipts')->with('policies', $policies);
    }

    public function generatePDF($RID)
    {
        $policies = DB::table('policies')
            ->join('receipts', 'policies.id', 'receipts.POLICY_ID_FK')
            ->join('corporates', 'policies.cust_id', 'corporates.id')
            ->select('policies.*', 'receipts.id as RID', 'receipts.STAMP_ID_FK', 'corporates.name as cp_name')
            ->where('receipts.id', $RID)->get();
        //foreach($policies as $r){
        $LBP= 1515 * $policies[0]->amount;
        $draft = explode('/', $policies[0]->draft_no);
        $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
        $word = $f->format($policies[0]->amount);
            $data = [

                'receipt_id' => $RID,
                'amount' => $policies[0]->amount,
                'amount1' => $LBP,
                'client_id' => $policies[0]->client_id,
                'policy' => $policies[0]->policy,
                'client_no' => $policies[0]->client_no,
                'client_name' => $policies[0]->client_name,
                'cp_name' => $policies[0]->cp_name,
                'due_date' => $policies[0]->due_date,
                'draft' => $draft[0],
                'sum' => $word.' USD ONLY',
                'paid_at' => $policies[0]->paid_at,
                ];
     //   }
        $path=storage_path().'/'.$policies[0]->phone;
        File::makeDirectory($path, 0777, true, true);
        $pdf = PDF::loadView('receipts.150', $data);
        $pdf->save(storage_path().'/'.$RID.'_'.$policies[0]->client_name.'_'.$draft[0].'.pdf');
    }

    public function getPDF($RID){
        $policies = DB::table('policies')
            ->join('receipts', 'policies.id', 'receipts.POLICY_ID_FK')
            ->join('corporates', 'policies.cust_id', 'corporates.id')
            ->select('policies.*', 'receipts.id as RID', 'receipts.STAMP_ID_FK', 'corporates.name as cp_name')
            ->where('receipts.id', $RID)->get();
        $draft = explode('/', $policies[0]->draft_no);
        $path =storage_path().'/'.$policies[0]->phone.'/'.$RID.'_'.$draft[0].'.pdf';
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$RID.'_'.$draft[0].'.pdf"'
        ]);
    }
}
