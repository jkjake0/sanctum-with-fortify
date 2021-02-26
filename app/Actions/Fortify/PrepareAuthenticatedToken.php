<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\LoginRateLimiter;

class PrepareAuthenticatedToken
{
    /**
     * The login rate limiter instance.
     *
     * @var LoginRateLimiter
     */
    protected $limiter;

    /**
     * Create a new class instance.
     *
     * @param LoginRateLimiter $limiter
     * @return void
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        $this->limiter->clear($request);

        $request->user()->tokens()->delete();

        return $next($request);
    }
}
