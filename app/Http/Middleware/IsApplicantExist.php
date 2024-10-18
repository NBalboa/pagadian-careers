<?php

namespace App\Http\Middleware;

use App\Enums\IsDeletedUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsApplicantExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $applicant = $request->route('applicant');
        $user = User::find($applicant->user_id);

        if ($user->is_deleted === IsDeletedUser::NO->value) {
            return $next($request);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
