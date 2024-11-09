<?php

namespace App\Http\Middleware;

use App\Enums\IsDeletedUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUserExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->is_deleted === IsDeletedUser::NO->value) {
            return $next($request);
        }

        auth()->logout();
        session()->regenerate();
    }
}