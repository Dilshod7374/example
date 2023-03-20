<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

public function register_store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email:rfc,d
        ns|unique:users,email',
        'password' => 'required|min:8',
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $user = User::create($validated);

    auth()->login($user);

    return redirect('/')->with('success', "Account successfully registered.");
}

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
}
}
