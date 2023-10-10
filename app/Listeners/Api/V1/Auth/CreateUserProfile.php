<?php

namespace App\Listeners\Api\V1\Auth;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Api\V1\Auth\UserProfileCreated;

class CreateUserProfile
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserProfileCreated $event): void
    {
        $event->user->profile()->create([]);
    }
}
