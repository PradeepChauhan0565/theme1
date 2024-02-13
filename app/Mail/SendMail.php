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
        } elseif ($this->details['title'] == "register") {
            return $this->subject('Thank you for Sign Up')
                ->view('order-mails.registerMail');
        } elseif ($this->details['title'] == "giftcard") {
            return $this->subject('Thank you for buy Gift card')
                ->view('gift_card_email', compact('details'));
        } elseif ($this->details['title'] == "shipped") {
            $order = \App\Models\Order::find($this->details['id']);
            return $this->subject('Order has been shipped')
                ->view('order-mails.order_shipped_mail', compact('details', 'order'));
        } elseif ($this->details['title'] == "cancelled") {
            $order = \App\Models\Order::find($this->details['id']);
            return $this->subject('Order has been cancelled')
                ->view('order-mails.order_cancel_mail', compact('details', 'order'));
        } elseif ($this->details['title'] == "delivered") {
            $order = \App\Models\Order::find($this->details['id']);
            return $this->subject('Order has been delivered')
                ->view('order-mails.order_delivered_mail', compact('details', 'order'));
        } else {
            return $this->subject('Thank you for order')
                ->view('order_thank_you');
        }
    }
}
