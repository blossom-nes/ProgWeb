<!DOCTYPE html>
<html>
<head>
    <title>Réservation</title>
</head>
<body>

<h1>Finaliser la réservation</h1>

{{-- Résumé du panier --}}
<h2>Récapitulatif de votre panier</h2>

@php $total = 0; @endphp

@forelse($panier as $id => $item)
    <p>
        {{ $item['nom'] }} —
        {{ $item['quantite'] }} billet(s) x {{ $item['prix'] }} € =
        <strong>{{ $item['quantite'] * $item['prix'] }} €</strong>
    </p>
    @php $total += $item['quantite'] * $item['prix']; @endphp
@empty
    <p>Votre panier est vide.</p>
@endforelse

<p><strong>Total : {{ $total }} €</strong></p>

<hr>

{{-- Formulaire coordonnées --}}
<h2>Vos coordonnées</h2>

<form action="/reservation" method="POST">
    @csrf

    <label>Prénom</label><br>
    <input type="text" name="prenom" value="{{ old('prenom') }}" required><br><br>

    <label>Nom</label><br>
    <input type="text" name="nom" value="{{ old('nom') }}" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Téléphone</label><br>
    <input type="text" name="telephone" value="{{ old('telephone') }}" required><br><br>

    {{-- Erreurs de validation --}}
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <button type="submit">Confirmer la réservation</button>
</form>

<br>
<a href="/panier">← Retour au panier</a>

</body>
</html>