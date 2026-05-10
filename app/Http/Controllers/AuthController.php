<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     * Utilisé dans : resources/views/auth/createLogin.blade.php
     * Route : GET /register
     */
    public function createForm()
    {
        return view('auth.createLogin');
    }

    /**
     * Enregistre un nouvel utilisateur en base de données.
     * Valide les champs, hache le mot de passe, crée le compte.
     * Redirige vers : /login
     * Route : POST /register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Compte créé');
    }

    /**
     * Affiche le formulaire de connexion.
     * Utilisé dans : resources/views/auth/login.blade.php
     * Route : GET /login
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Connecte l'utilisateur avec ses identifiants.
     * Redirige vers /admin si l'utilisateur est admin, sinon vers /account.
     * Route : POST /login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirige selon le rôle de l'utilisateur
            return redirect(Auth::user()->role === 'admin' ? '/admin' : '/account');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }

    /**
     * Déconnecte l'utilisateur et invalide la session.
     * Redirige vers : /login
     * Route : POST /logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Affiche la page du compte utilisateur connecté.
     * Protégée par le middleware auth (voir web.php).
     * Utilisé dans : resources/views/auth/account.blade.php
     * Route : GET /account
     */
    public function account()
    {
        return view('auth.account');
    }
}