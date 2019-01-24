<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class AdminAuth
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
        $token = $request->session()->get('token');
        $user_info = DB::table('admin_user')->where('token',$token)->first();
        if (empty($token) || empty($user_info)){
            return redirect('/login');
        }
        return $next($request);
    }
}
