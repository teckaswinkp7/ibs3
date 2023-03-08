<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;
    public function __construct($req)
    {
        $this->data=$req;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('sam@ibs.ac.pg')->view('emails.orders.shipped',['data'=>$this->data])->subject('VERIFICATION CODE');
    }
}
