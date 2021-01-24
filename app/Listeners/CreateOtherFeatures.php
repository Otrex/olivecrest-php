<?php

namespace App\Listeners;

use App\Models\Token;
use App\Models\User;
use App\Models\Verify;
use App\Models\Account;
use App\Models\Profile;
use App\Events\Register;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOtherFeatures
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
        $t = Verify::create([
            'user_id'=>$event->user->id, 
            'token'=> $event->user->token
        ]);

       
        Account::create([
            'user_id'=>$event->user->id
        ]);

        Profile::create([
            'user_id' => $event->user->id,
            'firstname' => $event->request->get('firstname'),
            'lastname' => $event->request->get('lastname'),
            'country' => $event->request->get('country'),
        ]);

    }
}
