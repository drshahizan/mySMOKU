<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailTamatPenajaan extends Mailable
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
        
        $subject = "PEMAKLUMAN AWAL PENAMATAN PENAJAAN OKU";
        return $this->subject($subject)
                    ->view('kemaskini.pelajar.tamat_penajaan')
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
