<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    
    public function login(Request $request)
{

    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate(); 
        return redirect()->route('admin.dashboard');
    }

    return back()->withInput()->with('error', 'Username atau password salah');
}


   
    public function logout(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login.form');
}

}
