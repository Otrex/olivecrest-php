<?php

namespace App\Listeners;

use App\Events\Transactions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTransaction
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
     * @param  Transactions  $event
     * @return void
     */
    public function handle(Transactions $event)
    {
        //
    }
}
