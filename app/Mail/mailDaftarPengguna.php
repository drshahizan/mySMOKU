<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class maildaftarPengguna extends Mailable
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
        $subject = "Daftar Pengguna Sistem BKOKU";
        return $this->subject($subject)
                    ->view('pages.pentadbir.emel-daftar')
                    ->with([
                        'email' => $this->email,
                        'no_kp' => $this->no_kp,
                    ]);
                    
    }
}
