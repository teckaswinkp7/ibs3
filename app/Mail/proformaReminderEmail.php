<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class proformaReminderEmail extends Mailable implements shouldQueue
{
    use Queueable, SerializesModels;
    private $proformareminders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proformareminders)

    {
        $this->proformareminders = $proformareminders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.proformareminder-email')->with('proformareminders',$this->proformareminders);
    }
}
