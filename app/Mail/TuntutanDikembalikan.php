<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TuntutanDikembalikan extends Mailable
{
    use Queueable, SerializesModels;

    public $catatan;

    public function __construct($catatan)
    {
        $this->catatan = $catatan;
    }

    public function build()
    {
        return $this->view('tuntutan.sekretariat.saringan.email_kembalikan')->with('data', $this->catatan)->subject("BKOKU: Tuntutan Dikembalikan");
    }
}
