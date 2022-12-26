<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderSuccess;
use Illuminate\Support\Facades\Mail;

class OrderSuccessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $order;
    private $pdf_path;
    public function __construct($order = null, $pdf_path = null)
    {
        $this->order = $order;
        $this->pdf_path = $pdf_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!empty($this->order) && !empty($this->pdf_path)) {
            Mail::to($this->order['email'])->send(new OrderSuccess($this->order['MaHD'], $this->pdf_path));
            unlink($this->pdf_path);
        }
    }
}
