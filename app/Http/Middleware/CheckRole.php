<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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

        $currentUser = auth()->user();

        if ($currentUser->isSubUser() && in_array('sub_user', $roles)) {
            return $next($request);
        }

        if ($currentUser->hasRole($roles)) {
            return $next($request);
        }

        abort(403);
    }
}
