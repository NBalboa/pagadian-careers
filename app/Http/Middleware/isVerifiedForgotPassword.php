<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class isVerifiedForgotPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isVerifiedForgotPassword = Session::get('verified_forgot_password');

        if ($isVerifiedForgotPassword) {
            return $next($request);
        }
        abort(Response::HTTP_FORBIDDEN);
    }
}
