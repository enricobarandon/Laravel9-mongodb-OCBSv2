<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $user = Auth::user();

        if($user->isAdmin()) {
            return $next($request);
        }
        
        foreach($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
            // continue;
        }

        return redirect('/home')->with('error','Access denied');
    }
}
