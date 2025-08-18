<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 👉 Exibe tela de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 👉 Faz login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', '🎉 Login realizado com sucesso!');
        }

        return back()->withErrors(['email' => 'E-mail ou senha incorretos.']);
    }

    // 👉 Exibe tela de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 👉 Faz cadastro
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', '🎉 Conta criada com sucesso!');
    }

    // 👉 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', '👋 Logout realizado!');
    }
}
