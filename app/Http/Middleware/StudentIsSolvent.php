<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentIsSolvent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->hasRole('student')) {
            return $next($request);
        }

        if (!$user->is_solvent) {
            return redirect('studentIsNotSolvent');
        }

        return $next($request);
    }
}
