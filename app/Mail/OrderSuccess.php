<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $MaHD;
    private $pdf_path;
    public function __construct($MaHD, $pdf_path)
    {
        $this->MaHD = $MaHD;
        $this->pdf_path = $pdf_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_success')
                    ->with(['MaHD' => $this->MaHD])
                    ->attach($this->pdf_path);
    }
}
