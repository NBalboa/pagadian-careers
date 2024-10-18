<?php

namespace App\Http\Middleware;

use App\Enums\IsDeletedCompany;
use App\Models\HiringManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsCompanyExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $hiring_manager = HiringManager::where('user_id', $user->id)->first();
        $company = $hiring_manager->company()->get()->first();

        if (Auth::check() && $company->is_deleted === IsDeletedCompany::NO->value) {
            return $next($request);
        }
        auth()->logout();
        session()->regenerate();
    }
}
