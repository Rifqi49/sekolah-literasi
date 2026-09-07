<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Form login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password tidak sesuai.',
                ])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Redirect berdasarkan role
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->isAdmin()) {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/student/dashboard');
    }

    /**
     * Form register
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register student
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),

            // Semua user yang mendaftar dari website = student
            'role' => 'student',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/student/dashboard')
            ->with('success', 'Registrasi berhasil. Selamat datang di Sekolah Literasi!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Anda berhasil logout.');
    }
}