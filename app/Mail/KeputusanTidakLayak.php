<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KeputusanTidakLayak extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    /**
     * Create a new message instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build new message instance.
     */
    public function build()
    {
        $subject = "Keputusan Permohonan Anda";
        return $this->subject($subject)
                    ->with('data', $this->message)
                    ->view('permohonan.sekretariat.kelulusan.emel_tidak_lulus');
    }
}
