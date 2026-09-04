<?php

namespace App\Providers;

use App\Models\Inquiry;
use App\Models\Property;
use App\Policies\InquiryPolicy;
use App\Policies\PropertyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Gate::policy(Property::class, PropertyPolicy::class);
        Gate::policy(Inquiry::class, InquiryPolicy::class);
    }
}
