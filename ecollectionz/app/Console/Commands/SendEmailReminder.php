<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class SendEmailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email of registered users before due date 24 hours';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      //  echo "done";
        $totalUsers = DB::select('SELECT users.name as USNAME, users.phone as USPHONE,
                        users.email as USEMAIL,corporates.name as CP_NAME
                    FROM ( select client_name, phone, draft_no, 
                    status, max(created_at) as created_at from policies group by client_name, phone, draft_no ) A 
                    INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
                    INNER JOIN corporates ON B.cust_id =corporates.id  
                    INNER JOIN users ON B.phone =users.phone  
                    where B.due_date = DATE_ADD(CURRENT_DATE(), INTERVAL 2 DAY) and (B.status<>"P" or B.status<>"P-online")');
                foreach($totalUsers as $t){
                    $string = 'dddd';
                    $string=$t->CP_NAME."!".$t->USNAME;
                    Mail::to($t->USEMAIL)->send(new SendMailable($t));
                }
        
    }
}
