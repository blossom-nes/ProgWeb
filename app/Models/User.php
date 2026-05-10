<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Table : users
 * Représente un utilisateur du site.
 * Le champ 'role' détermine l'accès :
 *   - 'user'  → accès public uniquement
 *   - 'admin' → accès à l'espace organisateur (/admin)
 * Utilisé dans : AuthController, middleware IsAdmin
 */
#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Vérifie si l'utilisateur est un organisateur (admin).
     * Utilisé dans : middleware IsAdmin, vues Blade (@if(auth()->user()->isAdmin()))
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}