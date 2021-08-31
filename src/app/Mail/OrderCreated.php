<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $order;
    
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $file = storage_path('app/order_'.$this->order->id.'.xlsx');

        return $this->from('eazyordering@mail.com', 'Eazy Ordering')
                ->view('emails.orders.created')
                ->attach($file)
                ->to('dayannis.y@gmail.com');
    }
}
