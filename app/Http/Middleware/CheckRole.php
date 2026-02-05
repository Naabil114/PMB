<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $guard = 'web'; 
        if ($request->is('pendaftar/*')) {
            $guard = 'pendaftar';
        }

        if (!Auth::guard($guard)->check()) {
            return redirect()->route($guard === 'web' ? 'admin.login.form' : 'pendaftar.login.form');
        }

        $user = Auth::guard($guard)->user();

        if (!in_array($user->role->nama_role, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
