<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JO 2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4" style="max-width:800px">

    <div class="mb-4">
        <a href="/" class="me-3">Accueil</a>
        <a href="/calendrier" class="me-3">Calendrier</a>
        <a href="/competitions" class="me-3">Billetterie</a>
        <a href="/panier" class="me-3">Panier</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="/admin" class="me-3">Admin</a>
            @endif
            <a href="/account" class="me-3">Mon compte</a>
            <form method="POST" action="/logout" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-secondary">Déconnexion</button>
            </form>
        @else
            <a href="/login" class="me-3">Connexion</a>
            <a href="/register">Inscription</a>
        @endauth
    </div>

    <hr class="mb-4">

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @yield('content')

</body>
</html>