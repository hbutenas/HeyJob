<?php

namespace App\Providers;

use App\Events\Api\V1\Auth\CompanyProfileCreated;
use App\Events\Api\V1\Auth\UserProfileCreated;
use App\Listeners\Api\V1\Auth\CreateCompanyProfile;
use App\Listeners\Api\V1\Auth\CreateUserProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserProfileCreated::class => [
            CreateUserProfile::class
        ],
        CompanyProfileCreated::class => [
            CreateCompanyProfile::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
