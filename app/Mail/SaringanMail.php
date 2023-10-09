<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaringanMail extends Mailable
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
       return $this->view('permohonan.sekretariat.saringan.email_kembalikan')->with('data', $this->catatan)->with('emel', $this->emel)->subject($this->subjek);
    }
}
