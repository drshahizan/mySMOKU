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

    public $emailTidakLulus;
    public $catatanArray;
    /**
     * Create a new message instance.
     */
    public function __construct($email,$catatan)
    {
        $this->emailTidakLulus = $email;
        $this->catatanArray = $catatan;
    }

    /**
     * Build new message instance.
     */
    public function build()
    {
        $subject = "KEPUTUSAN PERMOHONAN BANTUAN KHAS OKU";
        return $this->subject($subject)
                    ->view('permohonan.sekretariat.kelulusan.emel_tidak_lulus');
    }
}
