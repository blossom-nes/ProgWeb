<h1>Admin - Compétitions</h1>

<a href="/admin/create">Ajouter</a>

@foreach($competitions as $c)
    <p>
        {{ $c->discipline->nom }} -
        {{ $c->tour->nom }} -
        {{ $c->site->nom }} -
        {{ $c->date }}

        <a href="/admin/{{ $c->id }}/edit">Modifier</a>

        <form action="/admin/{{ $c->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Supprimer</button>
        </form>
    </p>
@endforeach