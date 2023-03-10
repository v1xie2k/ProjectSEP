<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $daftarItem;
    protected $waktuTrans;
    public function __construct($inputItem,$inputWaktu)
    {
        $this->daftarItem = $inputItem;
        $this->waktuTrans = $inputWaktu;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        // $tanggal = Carbon::now()->isoFormat('d M Y H:m:s');
        return $this->subject('Invoice Transaction -'.getYangLogin()->name)->view('client.user.email')->with([
            'user' => getYangLogin(),
            'daftarItems' => $this->daftarItem,
            'tanggal' => $this->waktuTrans
        ]);

    }
}
