<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;  

    /**
     * Create a new message instance.
     *
     * @param array $subscription
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Subscription Confirmation - ' . config('app.name'))
            ->view('email.subscription')
            ->with([
                'subscription' => $this->subscription,
            ]);
    }
}
