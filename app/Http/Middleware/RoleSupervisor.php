<?php

namespace Cosapi\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RoleSupervisor
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(
            Auth::check() &&
            (
                Auth::user()->role == 'supervisor' ||
                Auth::user()->role == 'admin' ||
                Auth::user()->role == 'cliente' ||
                Auth::user()->role == 'calidad' ||
                Auth::user()->role == 'backoffice')
            )
        {
            return $next($request);
        }
        return redirect('/errorRole');
    }
}
