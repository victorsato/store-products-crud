<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product, $subject)
    {
        $this->product = $product;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@adm.com', 'Nome APP')->replyTo('site@adm.com', 'Site')->subject($this->subject)->view('mail.product');
    }
}
