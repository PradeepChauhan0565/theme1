<?php

namespace App\Mail;

use App\Models\Subscribe;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $details;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $details = $this->details;
        if ($this->details['title'] == "Subscribe") {
            $email = $this->details['email'] ?? null;
            return $this->subject('Thank you for Subscribing')
                ->view('subscribe', compact('email'));
        }
    }
}
