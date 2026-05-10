@extends('layouts.app')
@section('content')
<h1>Connexion</h1>

<form method="POST" action="/login">
    @csrf

    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Mot de passe"><br>

    <button>Se connecter</button>
</form>

@error('invalid')
    <p>{{ $message }}</p>
@enderror
@endsection