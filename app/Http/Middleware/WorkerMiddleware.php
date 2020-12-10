<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WorkerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id == 3)
            return $next($request);

        return redirect('/');
    }
}
