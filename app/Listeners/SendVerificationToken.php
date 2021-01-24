<?php

namespace App\Listeners;

use App\Events\Register;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationToken
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
     * @param  Register  $event
     * @return void
     */
    public function handle(Register $event)
    {
        $details = (object) [];
        $details->subject = 'Verification Mail';
        $details->token = $event->user->token;
        $details->to = $event->user->email;
        $details->firstname = $event->request->firstname;
        $details->lastname = $event->request->lastname;
        $details->url =  env('APP_URL').'/auth/verify/'.$event->user->email.'/';

        return $this->sendMail($details);
    }

    public function sendMail($details){
        \Mail::to($details->to)->send(new \App\Mail\NewUserMail($details));

        if (Mail::failures()) {
            return response()->json([
                'status'  => false,
                'data'    => $details,
                'message' => 'Nnot sending mail.. retry again...'
            ]);
        }
    }
}
