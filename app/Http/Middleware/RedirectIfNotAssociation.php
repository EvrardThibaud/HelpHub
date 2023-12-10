<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAssociation
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('association')->check()) {
            return redirect()->route('login_asso');
        }

        return $next($request);
    }
}
