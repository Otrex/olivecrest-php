<?php

namespace App\Listeners;

use App\Events\Transactions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Transaction;
use App\Models\WalletRequest;
use Auth;
class AddTransaction
{
    public $type = 'add';
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
     * @param  Transactions  $event
     * @return void
     */
    public function handle(Transactions $event)
    {
        if ($event->type != 'add') return;
        $data = $event->data;

        $transaction = Transaction::create([
            'user_id' => $data->user_id ?? auth()->user()->id,
            'type' => $data->type,
            'currency' => $data->currency,
            'status' => $data->status,
            'amount' => $data->amount,
        ]);

        WalletRequest::find($event->id)->delete();

        $this->sendMail($transaction);

    }
    public function sendMail($details){
        $details->firstname = auth()->user()->profile->firstname;
        \Mail::to($details->user()->email)->send(new \App\Mail\TransactionMailer($details));

        if (Mail::failures()) {
            return response()->json([
                'status'  => false,
                'data'    => $details,
                'message' => 'Nnot sending mail.. retry again...'
            ]);
        }
    }
}
