<h1>Modifier compétition</h1>

<form method="POST" action="/admin/{{ $competition->id }}">
    @csrf
    @method('PUT')

    <label>Discipline</label>
    <select name="discipline_id">
        @foreach($disciplines as $d)
            <option value="{{ $d->id }}"
                {{ $competition->discipline_id == $d->id ? 'selected' : '' }}>
                {{ $d->nom }}
            </option>
        @endforeach
    </select>

    <label>Tour</label>
    <select name="tour_id">
        @foreach($tours as $t)
            <option value="{{ $t->id }}"
                {{ $competition->tour_id == $t->id ? 'selected' : '' }}>
                {{ $t->nom }}
            </option>
        @endforeach
    </select>

    <label>Site</label>
    <select name="site_id">
        @foreach($sites as $s)
            <option value="{{ $s->id }}"
                {{ $competition->site_id == $s->id ? 'selected' : '' }}>
                {{ $s->nom }}
            </option>
        @endforeach
    </select>

    <label>Date</label>
    <input type="date" name="date" value="{{ $competition->date }}">

    <label>Heure début</label>
    <input type="time" name="heure_debut" value="{{ $competition->heure_debut }}">

    <label>Heure fin</label>
    <input type="time" name="heure_fin" value="{{ $competition->heure_fin }}">

    <label>Prix</label>
    <input type="number" name="prix" value="{{ $competition->prix }}">

    <button>Modifier</button>
</form>