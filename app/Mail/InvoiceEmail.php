<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
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
        return $this->from('info@supertyreguy.com')->view('emails.offers.invoiceEmail',['data'=>$this->data])->subject('Invoice')->attach(public_path('public/uploads/attachment/'.$this->data['filename']));    
    }
}
