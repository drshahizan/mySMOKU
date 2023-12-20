<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class MailDaftarPengguna extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $no_kp;
    /**
     * Create a new message instance.
     */
    public function __construct($email, $no_kp)
    {
        $this->email = $email;
        $this->no_kp = $no_kp;
    }

    /**
     * Build new message instance.
     */
    public function build()
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60), // Adjust the expiration time as needed
            ['id' => $this->no_kp, 'hash' => sha1($this->email)]
        );

        $subject = "DAFTAR PENGGUNA SISTEM BKOKU";
        return $this->subject($subject)
                    ->view('kemaskini.pentadbir.emel-daftar')
                    ->with([
                        'email' => $this->email,
                        'no_kp' => $this->no_kp,
                        'verificationUrl' => $verificationUrl,
                    ]);
                    
    }
}
