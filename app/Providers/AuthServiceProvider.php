<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Booking\Offer;
use App\Models\Booking\Provider;
use App\Policies\Booking\OfferPolicy;
use App\Policies\Booking\ProviderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Booking
        Offer::class => OfferPolicy::class,
        Provider::class => ProviderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
