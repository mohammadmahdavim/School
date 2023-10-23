<?php

namespace App\Http\Middleware;

use Closure;

class TecherCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            return redirect('/login');
        }
        if (auth()->user()->role == 'معلم' or auth()->user()->role == 'مدیر') {
            return $next($request);
        } else {
            return back()->withErrors('شما دسترسی لازم ندارید.');
        }
    }
}
