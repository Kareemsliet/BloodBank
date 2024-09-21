<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName=$request->route()->getName();

        $permission=Permission::whereRaw("FIND_IN_SET('$routeName',routes)")->first();

        if($permission){
            $user=$request->user();
            if(!$user->hasPermissionTo($permission)){
                abort(403);
            }
        }
        return $next($request);
    }
}
