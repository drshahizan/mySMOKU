<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TuntutanLayak extends Mailable
{
    use Queueable, SerializesModels;

    public $catatan;
    public $emel;
    public $subjek;

    public function __construct($catatan,$emel)
    {
        $this->catatan = $catatan;
        $this->catatan = $emel;
        $this->subjek = $emel->subjek;
    }

    public function build()
    {
        return $this->view('tuntutan.sekretariat.saringan.email_layak')->with('emel', $this->emel)->with('data', $this->catatan)->subject("BKOKU: Tuntutan Layak");
    }
}
