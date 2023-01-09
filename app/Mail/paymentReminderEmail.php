<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class paymentReminderEmail extends Mailable implements shouldqueue
{
    use Queueable, SerializesModels;
    private $paymentreminders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($paymentreminders)
    {
        $this->paymentreminder = $paymentreminders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.payment-email')->with('paymentreminders',$this->paymentreminders);
    }
}
