<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // აჩვენებს ლოგინის გვერდს
    public function showLogin()
    {
        return view('auth.login');
    }

    // სისტემაში შესვლის ლოგიკა
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // თუ ადმინია, მიდის ადმინის პანელში, თუ არა - კლიენტისაში
            if (Auth::user()->role === 'Admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/client/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // აჩვენებს რეგისტრაციის გვერდს
    public function showRegister()
    {
        return view('auth.register');
    }

    // ახალი მომხმარებლის რეგისტრაცია
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Client', // ყველა ახალი იუზერი ავტომატურად ხდება კლიენტი
        ]);

        Auth::login($user);

        return redirect('/client/dashboard');
    }

    // სისტემიდან გამოსვლა (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}