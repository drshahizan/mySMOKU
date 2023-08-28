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

    public function __construct($catatan)
    {
        $this->catatan = $catatan;
    }

    public function build()
    {
       return $this->view('pages.saringan.email-dikembalikan')->with('data', $this->catatan)->subject("BKOKU: Permohonan Dikembalikan");
    }
}
