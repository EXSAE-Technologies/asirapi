<?php

namespace App\Listeners;

use Fshangala\Faculty\Events\ProfileWasCreated;
use Fshangala\Cws\Core\WalletCore;

class CreateUserWallet
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
     * @param  \App\Events\ExampleEvent  $event
     * @return void
     */
    public function handle(ProfileWasCreated $event)
    {
        $wallet = new WalletCore();
        $wallet->createWallet($event->profile->user_id);
    }
}
