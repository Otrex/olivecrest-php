<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\Token;
use App\Events\Register;
use App\Events\WalletRequester;
use App\Events\Transactions;
use App\Events\PaymentConfirmed;

use App\Listeners\CreateOtherFeatures;
use App\Listeners\SendVerificationToken;
use App\Listeners\SendAccessToken;
use App\Listeners\SendWalletRequest;
use App\Listeners\AddTransaction;
use App\Listeners\SendPaymentNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Token::class => [ SendAccessToken::class ],
        Register::class => [
            CreateOtherFeatures::class,
            SendVerificationToken::class
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        WalletRequester::class => [ SendWalletRequest::class ],
        Transactions::class => [ AddTransaction::class ],
        PaymentConfirmed::class => [ SendPaymentNotification::class ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
