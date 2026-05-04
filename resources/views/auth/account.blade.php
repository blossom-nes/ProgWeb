<h1>Mon compte</h1>

@auth
    <p>Bienvenue {{ auth()->user()->name }}</p>

    <form method="POST" action="/logout">
        @csrf
        <button>Logout</button>
    </form>
@endauth