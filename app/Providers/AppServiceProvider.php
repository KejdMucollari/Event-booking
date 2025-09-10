<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Booking;
use App\Policies\EventPolicy;
use App\Policies\BookingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register Event Policy
        Gate::policy(Event::class, EventPolicy::class);

        // Register Booking Policy
        Gate::policy(Booking::class, BookingPolicy::class);
    }
}
