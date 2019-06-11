<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendReminder;
use DB;

class SendSMSReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remindersms:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending SMS reminder to users due_date before 24 hours';

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
        $totalUsers = DB::select('SELECT users.name as USNAME, users.phone as USPHONE,
                        users.email as USEMAIL,corporates.name as CP_NAME
                    FROM ( select client_name, phone, draft_no, 
                    status, max(created_at) as created_at from policies group by client_name, phone, draft_no ) A 
                    INNER JOIN policies B USING (client_name, phone, draft_no,created_at)
                    INNER JOIN corporates ON B.cust_id =corporates.id  
                    INNER JOIN users ON B.phone =users.phone  
                    where B.due_date = DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY) and (B.status<>\'P\' or B.status<>\'P-online\')');
                foreach($totalUsers as $t){
                    SendReminder::sendReminder($t->USPHONE, $t->USNAME, $t->CP_NAME);
                }
    }
}
