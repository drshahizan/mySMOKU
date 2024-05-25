<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengesahanCGPA extends Mailable
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


    public function build()
    {
        
        $subject = "PENGESAHAN PURATA NILAIAN GRED (PNG) DI BAWAH 2.0 BAGI PELAJAR PENERIMA BANTUAN KEWANGAN ORANG KURANG UPAYA (BKOKU) / PROGRAM PENDIDIKAN KHAS (PPK)";
        return $this->subject($subject)
                    ->view('permohonan.pelajar.pengesahan_cgpa')
                    ->with([
                        'catatan' => $this->catatan,
                        
                    ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
