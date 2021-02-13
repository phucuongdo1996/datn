<?php

namespace App\Http\Middleware;

use App\Repositories\Profile\ProfileRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;

class ProfileUser
{
    /**
     * @var \App\Repositories\Profile\ProfileEloquentRepository
     */
    private $profileRepository;

    /**
     * ProfileUser constructor.
     *
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->role == ADMIN) {
            return $next($request);
        }
        if (!$this->profileRepository->findByAttribute('user_id', $user->id)) {
            return redirect()->route(REGISTER_LINK_REDIRECT[$user->role]);
        }
        return $next($request);
    }
}
