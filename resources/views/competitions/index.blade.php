
@extends('layouts.app')
@section('content')
<h1>Liste des compétitions</h1>

{{-- Formulaire de filtre par prix --}}
<form method="GET" action="/competitions">
    <label>Prix min (€)</label>
    <input type="number" name="prix_min" value="{{ request('prix_min') }}" min="0" step="0.01">

    <label>Prix max (€)</label>
    <input type="number" name="prix_max" value="{{ request('prix_max') }}" min="0" step="0.01">

    <button type="submit">Filtrer</button>
    <a href="/competitions">Réinitialiser</a>
</form>

<hr>

@forelse($competitions as $c)
    <div>
        <strong>{{ $c->discipline->nom }}</strong><br>
        Tour : {{ $c->tour->nom }}<br>
        Lieu : {{ $c->site->nom }}<br>
        Date : {{ $c->jour }}<br>
        Heure : {{ $c->heure_debut }} - {{ $c->heure_fin }}<br>
        Prix : {{ $c->prix }} €<br>

        <form action="{{ route('panier.ajouter', ['id' => $c->id]) }}" method="POST">
            @csrf
            <label>Quantité :</label>
            <input type="number" name="quantite" value="1" min="1">
            <button type="submit">Ajouter au panier</button>
        </form>
        <hr>
    </div>
@empty
    <p>Aucune compétition trouvée pour ces critères de prix.</p>
@endforelse
<hr>
<a href="/panier"> Voir mon panier et valider la réservation</a>
@endsection