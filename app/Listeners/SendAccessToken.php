<?php

namespace App\Listeners;

use App\Events\Token;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAccessToken
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
    public function handle(Register $event)
    {
        $token = \App\Models\Token::updateOrCreate([
            'user_id'=> $user->id, 
            'token' => rand(10000, 99999),
        ]);

        $details = (object) [];
        $details->subject = 'Access Token';
        $details->token = $token->token;
        $details->firstname = $event->user->profile()->firstname;
        $details->lastname = $event->user->profile()->lastname;


        return $this->sendMail($details);
    }

    public function sendMail($details){
        \Mail::to($request->to)->send(new \App\Mail\NewUserMail($details));

        if (Mail::failures()) {
            return response()->json([
                'status'  => false,
                'data'    => $details,
                'message' => 'Nnot sending mail.. retry again...'
            ]);
        }
    }
}
