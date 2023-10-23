<?php

namespace App\Http\Middleware;

use Closure;

class StatusCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = auth()->user()->status;
        if ($status == 1) {
            return $next($request);

        } else {
            alert()->warning('منتظر تایید مدیر!!', 'ناموفق');
            return redirect('/profile');
        }
    }
}
