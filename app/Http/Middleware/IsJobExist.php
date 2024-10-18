<?php

namespace App\Http\Middleware;

use App\Enums\IsDeletedJob;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsJobExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $job = $request->route('job');
        if ($job->is_deleted === IsDeletedJob::NO->value) {
            return $next($request);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
