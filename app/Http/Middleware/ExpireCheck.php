<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class ExpireCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guest()){
            return redirect('/login');
        } else {
            $user = Auth::user();
            if($user->expire_token > Carbon::now()){
                $user->expire_token = Carbon::now()->addMinutes(15);
                $user->save();
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/login');
            }
        }

    }
}
