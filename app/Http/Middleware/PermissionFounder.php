<?php

namespace App\Http\Middleware;

use Closure;

class PermissionFounder
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
        $urlCurrent = $request->url();
        $request->session()->put('urlCurrent', $urlCurrent);
        
        if($request->session()->has('userInfo'))  {
            $userInfo = $request->session()->get('userInfo');

            if ($userInfo['level'] == 'founder')  return $next($request);
            return redirect()->route('notify/noPermission');
        }

        return redirect()->route('auth/login');
    }
}

// news/login