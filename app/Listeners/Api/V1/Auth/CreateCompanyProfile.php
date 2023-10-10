<?php

namespace App\Listeners\Api\V1\Auth;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Api\V1\Auth\CompanyProfileCreated;

class CreateCompanyProfile
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
    public function handle(CompanyProfileCreated $event): void
    {
        $event->user->company()->create([]);
    }
}
