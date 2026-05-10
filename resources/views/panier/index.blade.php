
@extends('layouts.app')
@section('content')
<h1>Mon panier</h1>

@php $total = 0; @endphp

@foreach($panier as $id => $item)
    <p>
        {{ $item['nom'] }} |
        Quantité : {{ $item['quantite'] }} |
        Prix : {{ $item['prix'] }} €

        @php
            $total += $item['prix'] * $item['quantite'];
        @endphp
    </p>
@endforeach

<h3>Total : {{ $total }} €</h3>

<a href="/reservation">Valider la réservation</a>
@endsection