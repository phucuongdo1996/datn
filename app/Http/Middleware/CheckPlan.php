<?php

namespace App\Http\Middleware;

use Closure;

class CheckPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string[] ...$roles
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (empty($roles)) {
            return $next($request);
        }

        $currentUser = auth()->user()->isMainUser() ? auth()->user() : auth()->user()->getParentUser();

        if ($currentUser->hasPlan($roles)) {
            return $next($request);
        }

        abort(403);
    }
}
