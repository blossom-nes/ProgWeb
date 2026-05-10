<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin

{
    /* Protège les routes réservées aux organisateurs des JO.
 *   Enregistré dans bootstrap/app.php sous l'alias 'isAdmin'.
 *   Utilisé dans : routes/web.php sur le groupe de routes /admin
    */
    public function handle(Request $request, Closure $next)
    {
        // auth()->check() vérifie si l'utilisateur est connecté
        // auth()->user()->role vérifie son rôle dans la table users
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            
            abort(403, 'Accès réservé aux organisateurs.');
        }
        // $next($request) transmet la requête au contrôleur suivant

        return $next($request);
    }
}
