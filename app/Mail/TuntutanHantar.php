<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TuntutanHantar extends Mailable
{
    use Queueable, SerializesModels;

    public $catatan;
    public $emel;
    public $subjek;

    public function __construct($catatan,$emel)
    {
        $this->catatan = $catatan;
        $this->emel = $emel;
        $this->subjek = $emel->subjek;
    }

    public function build()
    {
        return $this->view('tuntutan.pelajar.email_hantar')->with('emel', $this->emel)->with('data', $this->catatan)->subject($this->subjek);
    }
}
