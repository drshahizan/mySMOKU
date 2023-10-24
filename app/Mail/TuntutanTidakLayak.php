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

    public $saringan;
    public $tuntutan_item;
    public $emel;
    public $subjek;

    public function __construct($saringan,$tuntutan_item,$emel)
    {
        $this->saringan = $saringan;
        $this->tuntutan_item = $tuntutan_item;
        $this->emel = $emel;
        $this->subjek = $emel->subjek;
    }

    public function build()
    {
        return $this->view('tuntutan.sekretariat.saringan.email_tidak_layak')->with('saringan', $this->saringan)->with('tuntutan_item', $this->tuntutan_item)->with('emel', $this->emel)->subject($this->subjek);
    }
}
