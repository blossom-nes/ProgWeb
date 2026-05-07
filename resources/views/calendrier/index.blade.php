<h1>Calendrier des compétitions</h1>

<!-- FILTRE -->
<form method="GET" action="/calendrier">
    <select name="discipline">
        <option value="">Toutes les disciplines</option>

        @foreach($disciplines as $d)
            <option value="{{ $d->id }}">
                {{ $d->nom }}
            </option>
        @endforeach
    </select>

    <button>Filtrer</button>
</form>

<hr>

<!-- AFFICHAGE -->
@foreach($competitionsParJour as $jour => $competitions)

    <h2>{{ $jour }}</h2>

    @foreach($competitions as $c)
        <p>
            {{ $c->discipline?->nom}} -
            {{ $c->tour?->nom }} -
            {{ $c->site?->nom }} <br>

             {{ $c->heure_debut }} - {{ $c->heure_fin }}
        </p>
    @endforeach

@endforeach