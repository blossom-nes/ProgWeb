<h1>Liste des compétitions</h1>

@foreach($competitions as $c)
    <div>
        <strong>{{ $c->discipline->nom }}</strong><br>
        Tour : {{ $c->tour->nom }}<br>
        Lieu : {{ $c->site->nom }}<br>
        Date : {{ $c->date }}<br>
        Heure : {{ $c->heure_debut }} - {{ $c->heure_fin }}<br>
        Prix : {{ $c->prix }} €<br>
        <hr>
    </div>
@endforeach