<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $order;
    private $bank_setting;
    public function __construct($order, $bank_setting)
    {
        $this->order = $order;
        $this->bank_setting = $bank_setting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order_confirm')
                    ->with([
                        'order' => $this->order,
                        'bank_setting' => $this->bank_setting,
                    ]);
    }
}
