<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TuntutanTidakLayak extends Mailable
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
        return $this->view('tuntutan.sekretariat.saringan.email_tidak_layak')->with('data', $this->catatan)->with('emel', $this->emel)->subject("BKOKU: Tuntutan Tidak Layak");
    }
}
