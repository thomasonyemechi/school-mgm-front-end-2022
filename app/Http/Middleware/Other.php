<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Other
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(user()->permission->other == 1) {
            return $next($request);
        }
        return redirect('/control/dashboard')->with('error', 'You don\'t have permission carry out this operation');
    }
}
