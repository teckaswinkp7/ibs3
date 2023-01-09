<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class courseselectReminderEmail extends Mailable implements shouldQueue
{
    use Queueable, SerializesModels;
    private $docreminders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($docreminders)
    {
        $this->docreminders = $docreminders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.courseselect-email')->with('docreminders',$this->docreminders);
    }
}
