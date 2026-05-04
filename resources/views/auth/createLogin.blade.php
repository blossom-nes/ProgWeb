<h1>Créer un compte</h1>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Nom"><br>
    <input type="email" name="email" placeholder="Email"><br>

    <input type="password" name="password" placeholder="Mot de passe"><br>
    <input type="password" name="password_confirmation" placeholder="Confirmer"><br>

    <button>S'inscrire</button>
</form>