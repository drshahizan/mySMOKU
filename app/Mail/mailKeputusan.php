<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mailKeputusan extends Mailable
{
    use Queueable, SerializesModels;
    public $catatan;
    /**
     * Create a new message instance.
     */
    public function __construct($catatan)
    {
        $this->catatan = $catatan;
    }

    /**
     * Build new message instance.
     */
    public function build()
    {
        $subject = "Keputusan Permohonan Anda";
        return $this->subject($subject)
                    ->with('data', $this->catatan)
                    ->view('pages.sekretariat.permohonan.emel-kelulusan');
    }
}
