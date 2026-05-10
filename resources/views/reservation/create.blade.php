@extends('layouts.app')
@section('content')
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

{{-- Formulaire coordonnées acheteur + noms spectateurs --}}
<form action="/reservation" method="POST">
    @csrf

    <h2>Vos coordonnées (acheteur)</h2>

    <label>Prénom</label><br>
    <input type="text" name="prenom" value="{{ old('prenom') }}" required><br><br>

    <label>Nom</label><br>
    <input type="text" name="nom" value="{{ old('nom') }}" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Téléphone</label><br>
    <input type="text" name="telephone" value="{{ old('telephone') }}" required><br><br>

    <hr>

    {{-- Un bloc de champs par billet dans le panier --}}
    <h2>Noms des spectateurs</h2>
    <p><em>Renseignez le prénom et nom de chaque personne pour qui vous réservez un billet.</em></p>

    @php $index = 0; @endphp

    @foreach($panier as $id => $item)
        @for($i = 0; $i < $item['quantite']; $i++)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <strong>{{ $item['nom'] }} — Billet {{ $i + 1 }}</strong><br><br>

                <label>Prénom</label><br>
                <input type="text" name="spectateurs[{{ $index }}][prenom]"
                       value="{{ old('spectateurs.'.$index.'.prenom') }}" required><br><br>

                <label>Nom</label><br>
                <input type="text" name="spectateurs[{{ $index }}][nom]"
                       value="{{ old('spectateurs.'.$index.'.nom') }}" required><br><br>
            </div>
            @php $index++; @endphp
        @endfor
    @endforeach

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
@endsection