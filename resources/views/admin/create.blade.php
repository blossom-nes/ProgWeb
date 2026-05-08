<h1>Ajouter compétition</h1>

<form method="POST" action="/admin">
    @csrf

    <select name="discipline_id">
        @foreach($disciplines as $d)
            <option value="{{ $d->id }}">{{ $d->nom }}</option>
        @endforeach
    </select>

    <select name="tour_id">
        @foreach($tours as $t)
            <option value="{{ $t->id }}">{{ $t->nom }}</option>
        @endforeach
    </select>

    <select name="site_id">
        @foreach($sites as $s)
            <option value="{{ $s->id }}">{{ $s->nom }}</option>
        @endforeach
    </select>

    <input type="date" name="jour">
    <input type="time" name="heure_debut">
    <input type="time" name="heure_fin">
    <input type="number" name="prix">

    <button>Ajouter</button>
</form>