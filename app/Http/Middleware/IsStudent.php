<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStudent
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
        $studentRole = Role::where('name','student')->first();
        // dd(Auth::user()->role_id);
        if(Auth::user()->role_id == $studentRole->id ){
            return $next($request);
        }
        return redirect(url('/'));
    }
}
