
@extends('layouts.app')
@section('content')
<h1> Réservation confirmée !</h1>

@php $recap = session('recap'); @endphp

@if($recap)
    <h2>Vos coordonnées</h2>
    <p>
        {{ $recap['reservation']['prenom'] }} {{ $recap['reservation']['nom'] }}<br>
        Email : {{ $recap['reservation']['email'] }}<br>
        Téléphone : {{ $recap['reservation']['telephone'] }}
    </p>

    <h2>Billets réservés</h2>

    @php $total = 0; @endphp

    @foreach($recap['panier'] as $id => $item)
        <p>
            {{ $item['nom'] }} —
            {{ $item['quantite'] }} billet(s) x {{ $item['prix'] }} € =
            {{ $item['quantite'] * $item['prix'] }} €
        </p>
        @php $total += $item['quantite'] * $item['prix']; @endphp
    @endforeach

    <h3>Total payé : {{ $total }} €</h3>

    <h2>Spectateurs</h2>
    @foreach($recap['spectateurs'] as $s)
        <p>{{ $s['prenom'] }} {{ $s['nom'] }}</p>
    @endforeach

@else
    <p>Aucune réservation trouvée.</p>
@endif

<a href="/">Retour à l'accueil</a>
@endsection