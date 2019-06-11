<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegMailable;
use App\Jobs\SendEmailRegJob;
use Carbon\Carbon;

class EmailRegController extends Controller
{
    public function sendEmail()
    {
        $emailJob = (new SendEmailRegJob())->delay(Carbon::now()->addSeconds(3));
        dispatch($emailJob);

        echo 'email sent';
    }
}
