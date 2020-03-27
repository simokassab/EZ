<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $totalUsers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($totalUsers)
    {
        $this->totalUsers = $totalUsers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('ECOLLECTIONZ REMINDER')->view('Mails.registeredcount')
        ->with([
            'inputs' => $this->totalUsers,
          ]);
        
    }
}
