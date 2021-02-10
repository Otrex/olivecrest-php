<?php

namespace App\Listeners;

use App\Events\WalletRequester;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Setting;

class SendWalletRequest
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
     * @param  WalletRequester  $event
     * @return void
     */
    public function handle(WalletRequester $event)
    {

        $details = (object) [];
        $details->subject = $event->data['title'] ?? 'WithDrawal';
        $details->to = \utils\AppConfig::get('APP_EMAIL') ?? env('APP_EMAIL');
        $details->data = $event->data;
        $details->link = env('APP_URL') . '/admin';
    
        return $this->sendMail($details);
    }
    public function sendMail($details){
        \Mail::to($details->to)->send(new \App\Mail\WalletRequests($details));

        if (Mail::failures()) {
            return response()->json([
                'status'  => false,
                'data'    => $details,
                'message' => 'Nnot sending mail.. retry again...'
            ]);
        }
    }
}
