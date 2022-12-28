<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $superAdminRole = Role::where('name', 'superadmin')->first();
        if (Auth::user()->role_id == $superAdminRole->id) {
            return $next($request);
        }
        return redirect(url('/'));
    }
}
