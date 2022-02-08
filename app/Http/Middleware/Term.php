<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Term
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

        $info = session()->get('info') ?? [];
        $user = user();
        $term = $info['data']['term'] ?? [];
        if($term){
            return $next($request);
        }else{
            if($user->role == 10 || $user->permission->other == 1){
                return redirect('/control/setting/general')->
                with('error', 'Pls create a session and activate a term <br> You can see this page because you have the permission <br> others will not !');
            }
            return redirect('/login')->with('error', 'No active Term <br> contact an admin');
        }
    }
}
