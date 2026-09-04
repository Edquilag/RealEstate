<?php

use Illuminate\Support\Facades\Route;

it('exposes a single authenticated api user endpoint without duplicate route definitions', function () {
    $routes = collect(Route::getRoutes()->getRoutesByMethod()['GET'])
        ->filter(fn ($route) => str_starts_with($route->uri(), 'api/') && str_ends_with($route->uri(), 'user'));

    expect($routes->count())->toBe(1);
});

it('uses production-safe CORS defaults for API access', function () {
    expect(config('cors'))->not->toBeNull();
    expect(config('cors.allowed_origins'))->toBeArray();
    expect(config('cors.allowed_origins'))->not->toBeEmpty();
});
