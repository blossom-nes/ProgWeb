<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔹 Afficher le formulaire d'inscription
    public function createForm()
    {
        return view('auth.createLogin');
        // return "OK";
    }

    // 🔹 Enregistrer un utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Compte créé');
    }

    // 🔹 Afficher le formulaire de connexion
    public function loginForm()
    {
        return view('auth.login');
    }

    // 🔹 Connexion
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(Auth::user()->role === 'admin' ? '/admin' : '/account');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ]);
    }

    // 🔹 Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // 🔹 Page protégée
    public function account()
    {
        return view('auth.account');
    }
}