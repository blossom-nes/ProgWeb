<h1>Admin - Compétitions</h1>

<a href="/admin/create">Ajouter</a>

@foreach($competitions as $c)
    <p>
        {{ $c->discipline->nom }} -
        {{ $c->tour->nom }} -
        {{ $c->site->nom }} -
        {{ $c->date }}

        <br>
         Spectateurs : {{ $c->nb_spectateurs }}
        <br>
         Places restantes : {{ $c->places_restantes }}

        <br>

        <a href="/admin/{{ $c->id }}/edit">Modifier</a>

        <form action="/admin/{{ $c->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Supprimer</button>
        </form>
    </p>
@endforeach