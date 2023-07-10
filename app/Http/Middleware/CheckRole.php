<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{


    public function handle($request, Closure $next, $roles)
    {
        $user = Auth::user();

        if (in_array($roles, $user->role->permission)) {
            return $next($request);
        }
        return redirect("login");
    }


}
