@extends('layouts.app')
@section('content')

<div class="text-center py-5">
    <h1 class="mb-2"> Jeux Olympiques d'Hiver 2026</h1>
    <p class="text-muted mb-5">Milan — Cortina d'Ampezzo</p>

    <div class="row justify-content-center g-3">
        <div class="col-md-4">
            <div class="card p-4">
                <h5> Calendrier</h5>
                <p class="text-muted small">Consultez le programme des compétitions par discipline et par date.</p>
                <a href="/calendrier" class="btn btn-outline-secondary">Voir le calendrier</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h5> Billetterie</h5>
                <p class="text-muted small">Achetez vos billets pour assister aux épreuves en direct.</p>
                <a href="/competitions" class="btn btn-outline-secondary">Réserver des billets</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h5>Mon compte</h5>
                <p class="text-muted small">Connectez-vous pour gérer vos réservations.</p>
                @auth
                    <a href="/account" class="btn btn-outline-secondary">Mon compte</a>
                @else
                    <a href="/login" class="btn btn-outline-secondary">Se connecter</a>
                @endauth
            </div>
        </div>
    </div>
</div>

@endsection