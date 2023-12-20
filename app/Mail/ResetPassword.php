<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    
    public $token; // Define a public property to hold the token
    
    /**
     * Create a new message instance.
     *
     * @param string $token The token to include in the email
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the email message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages.auth.email_reset-password')
            ->subject('LUPA KATA LALUAN');
    }
}

