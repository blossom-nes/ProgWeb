
@extends('layouts.app')
@section('content')
<h1>Mon compte</h1>

@auth
    <p>Bienvenue {{ auth()->user()->name }}</p>

    <ul>
        <li><a href="/competitions"> Voir les compétitions et réserver</a></li>
        <li><a href="/panier"> Mon panier</a></li>
        <li><a href="/calendrier"> Calendrier des compétitions</a></li>
    </ul>

    <form method="POST" action="/logout">
        @csrf
        <button>Logout</button>
    </form>
@endauth
@endsection