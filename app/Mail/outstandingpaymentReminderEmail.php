<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class outstandingpaymentReminderEmail extends Mailable implements shouldqueue
{
    use Queueable, SerializesModels;
    private $outstandingpaymentreminders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($outstandingpaymentreminders)
    {
        $this->outstandingpaymentreminders = $outstandingpaymentreminders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.outstandingpayment-email')->with('outstandingpaymentreminders',$this->outstandingpaymentreminders);
    }
}
