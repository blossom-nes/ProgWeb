
@extends('layouts.app')
@section('content')
<h1>Modifier une compétition</h1>

<form method="POST" action="/admin/{{ $competition->id }}">
    @csrf
    @method('PUT')

    <label>Discipline</label><br>
    <select name="discipline_id">
        @foreach($disciplines as $d)
            <option value="{{ $d->id }}" {{ $competition->discipline_id == $d->id ? 'selected' : '' }}>
                {{ $d->nom }}
            </option>
        @endforeach
    </select><br><br>

    <label>Tour</label><br>
    <select name="tour_id">
        @foreach($tours as $t)
            <option value="{{ $t->id }}" {{ $competition->tour_id == $t->id ? 'selected' : '' }}>
                {{ $t->nom }}
            </option>
        @endforeach
    </select><br><br>

    <label>Site</label><br>
    <select name="site_id">
        @foreach($sites as $s)
            <option value="{{ $s->id }}" {{ $competition->site_id == $s->id ? 'selected' : '' }}>
                {{ $s->nom }}
            </option>
        @endforeach
    </select><br><br>

    <label>Date</label><br>
    <input type="date" name="jour" value="{{ $competition->jour }}"><br><br>  {{-- corrigé : était name="date" et value="$competition->date" --}}

    <label>Heure début</label><br>
    <input type="time" name="heure_debut" value="{{ $competition->heure_debut }}"><br><br>

    <label>Heure fin</label><br>
    <input type="time" name="heure_fin" value="{{ $competition->heure_fin }}"><br><br>

    <label>Prix (€)</label><br>
    <input type="number" name="prix" step="0.01" value="{{ $competition->prix }}"><br><br>

    <button type="submit">Modifier</button>
</form>

<br>
<a href="/admin">← Retour</a>
@endsection