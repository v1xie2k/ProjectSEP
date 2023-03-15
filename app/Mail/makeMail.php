<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class makeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $email ;
    protected $kode ;
    public function __construct($inputUser,$inputKode)
    {
        $this->email = $inputUser;
        $this->kode = $inputKode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tanggal = Carbon::now()->isoFormat("d M Y H:m:s");
        return $this->subject("Amazake Reset Password")
        ->view('previewEmail')
        ->with([
            "user"=> $this->email,
            "tanggal"=> $tanggal,
            "kode" => $this->kode
        ]);
    }
}
