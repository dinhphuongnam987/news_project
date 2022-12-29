<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class PermissionAdmin
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
        $routeCurrent = $request->route()->getName(); // article
        
        if($request->session()->has('userInfo'))  {
            $userInfo = $request->session()->get('userInfo');

            if ($userInfo['level'] == 'founder') {
                return $next($request);
            } else {
                if($userInfo['group_id'] !== null) {
                    $userGroupItem = DB::table('user_group')->where('id', $userInfo['group_id'])->select('permission_ids')->first();
                    $permission_ids = array_flip(json_decode($userGroupItem->permission_ids)); // permission_ids = [1,2,3]
                    $permissionItem = DB::table('permission')->select('id')->where('route_name', $routeCurrent)->first(); // {id: 1}

                    if(!empty($permissionItem)) {
                        if(array_key_exists($permissionItem->id, $permission_ids)) { // permissionItem->id : 1
                            return $next($request);
                        }
                    }
                }
            }
            return redirect()->back()->with("zvn_notify", 'Bạn không có quyền để thực hiện chức năng này!');
        }

        return redirect()->route('auth/login');
    }
}

// news/login