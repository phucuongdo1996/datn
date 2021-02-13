<?php

namespace App\Http\Middleware;

use App\Repositories\SubUserProperty\SubUserPropertyEloquentRepository;
use Closure;

class CheckPermissionsReport
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->isSubUser()) {
            return $next($request);
        }

        if (resolve(SubUserPropertyEloquentRepository::class)->handleCheckPermission($request->route('propertyId'), REPORT_SCREEN)) {
            return $next($request);
        }
        return redirect()->route(USER_REPORT)->with(STR_ERROR_FLASH, trans('messages.sub_user.report_permission_denied'));
    }
}
