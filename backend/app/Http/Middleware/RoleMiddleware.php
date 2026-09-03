<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{

    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response
    {
        if (! auth()->check()) {
            abort(403);
        }

        $user = auth()->user();

        if (! in_array($user->role, $roles, true)) {
            abort(403);
        }

        if ($user->role === 'broker' && ! $user->isApproved()) {
            abort(403, 'Broker account is awaiting approval.');
        }

        return $next($request);
    }

}