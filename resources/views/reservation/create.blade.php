<h1>Réservation</h1>

<form action="/reservation" method="POST">
    @csrf

    <input type="text" name="prenom" placeholder="Prénom"><br>
    <input type="text" name="nom" placeholder="Nom"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="text" name="telephone" placeholder="Téléphone"><br>

    <button type="submit">Confirmer la réservation</button>
</form>