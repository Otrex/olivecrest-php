<?php

namespace App\Listeners;

use App\Events\PaymentConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPaymentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentConfirmed  $event
     * @return void
     */
    public function handle(PaymentConfirmed $event)
    {
        $this->sendMail($event->data);
    }

     public function sendMail($details){
        \Mail::to($details->to)->send(new \App\Mail\ConfirmedPayment($details));

        if (Mail::failures()) {
            return response()->json([
                'status'  => false,
                'data'    => $details,
                'message' => 'Not sending mail.. retry again...'
            ]);
        }
    }
}
