<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class raiseReminderEmail extends Mailable implements shouldQueue
{
    use Queueable, SerializesModels;
    private $raisereminders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($raisereminders)
    {
        
        $this->raisereminders = $raisereminders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.raisereminder-email')->with('raisereminders',$this->$raisereminders);
    }
}
