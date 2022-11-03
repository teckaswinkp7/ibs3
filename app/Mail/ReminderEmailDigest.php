<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ReminderEmailDigest extends Mailable implements shouldqueue
{
    use Queueable, SerializesModels;


    private $reminders;
   

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reminders)
    {
        $this->reminders = $reminders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ibs@university.com')->markdown('emails.reminder-digest')
        ->with('reminders', $this->reminders)->subject('Reminder Email');
    }
}
