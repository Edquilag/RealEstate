<?php

namespace App\Providers;

use App\Models\Inquiry;
use App\Models\Property;
use App\Policies\InquiryPolicy;
use App\Policies\PropertyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Property::class => PropertyPolicy::class,
        Inquiry::class => InquiryPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
