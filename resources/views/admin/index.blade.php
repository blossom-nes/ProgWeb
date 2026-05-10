@extends('layouts.app')
@section('content')
<h1>Admin - Compétitions</h1>

<a href="/admin/create">Ajouter une compétition</a>

<hr>

@foreach($competitions as $c)
    <p>
        <strong>{{ $c->discipline->nom }}</strong> —
        {{ $c->tour->nom }} —
        {{ $c->site->nom }} —
        {{ $c->jour }}
        <br>
        Spectateurs : {{ $c->nb_spectateurs }} |
        Places restantes : {{ $c->places_restantes }}
        <br>
        <a href="/admin/{{ $c->id }}/edit">Modifier</a>
        <form action="/admin/{{ $c->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Supprimer cette compétition ?')">Supprimer</button>
        </form>
    </p>
@endforeach

<hr>

<h1>Réservations des clients</h1>

@forelse($reservations as $r)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>{{ $r->prenom }} {{ $r->nom }}</strong><br>
        Email : {{ $r->email }} | Tél : {{ $r->telephone }}<br>

        <strong>Compétitions réservées :</strong><br>
        @foreach($r->competitions as $c)
            — {{ $c->discipline->nom }} ({{ $c->tour->nom }}) —
            {{ $c->jour }} —
            {{ $c->pivot->quantite }} billet(s)
            à {{ $c->prix }} € =
            <strong>{{ $c->pivot->quantite * $c->prix }} €</strong><br>
        @endforeach

        <strong>Spectateurs :</strong><br>
        @foreach($r->spectateurs as $s)
            — {{ $s->prenom }} {{ $s->nom }}<br>
        @endforeach
    </div>
@empty
    <p>Aucune réservation pour le moment.</p>
@endforelse
@endsection