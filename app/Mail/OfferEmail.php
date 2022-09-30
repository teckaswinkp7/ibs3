<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferEmail extends Mailable
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
        return $this->from('info@supertyreguy.com')->view('emails.offers.offeremail',['data'=>$this->data])->subject('Offer Email')->attach(public_path('uploads/attachment/'.$this->data['filename']));    
    }
}
