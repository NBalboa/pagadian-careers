<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $user = Auth::user();
            // Redirect based on user role
            if ($user->role === UserRole::ADMIN->value) {
                return redirect('/dashboard');
            } elseif ($user->role === UserRole::HIRING_MANAGER->value) {
                return redirect('/hiringmanager/dashboard');
            } else {
                return redirect('/jobs');
            }
        }

        return $next($request);
    }
}
