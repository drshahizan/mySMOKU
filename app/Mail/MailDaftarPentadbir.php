<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class MailDaftarPentadbir extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $no_kp;
    public $password;
    /**
     * Create a new message instance.
     */
    public function __construct($email, $no_kp, $password)
    {
        $this->email = $email;
        $this->no_kp = $no_kp;
        $this->password = $password;
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
                    ->view('kemaskini.pentadbir.emel_daftar_pentadbir')
                    ->with([
                        'email' => $this->email,
                        'no_kp' => $this->no_kp,
                        'password' => $this->password,
                        'verificationUrl' => $verificationUrl,
                    ]);
                    
    }
}
