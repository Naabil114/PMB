<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminJwt
{
    public function handle($request, Closure $next)
    {
        if (! session()->has('admin_jwt')) {
            return redirect()->route('admin.login.form');
        }

        try {
            Auth::guard('api')->setToken(session('admin_jwt'))->authenticate();
        } catch (\Exception $e) {
            session()->forget('admin_jwt');
            return redirect()->route('admin.login.form');
        }

        return $next($request);
    }
}

