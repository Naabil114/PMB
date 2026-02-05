<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Tentukan guard berdasarkan route prefix
        $guard = 'web'; // default untuk admin/prodi
        if ($request->is('pendaftar/*')) {
            $guard = 'pendaftar';
        }

        if (!Auth::guard($guard)->check()) {
            // Redirect ke login sesuai guard
            return redirect()->route($guard === 'web' ? 'admin.login.form' : 'pendaftar.login.form');
        }

        $user = Auth::guard($guard)->user();

        // cek role
        if (!in_array($user->role->nama_role, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
