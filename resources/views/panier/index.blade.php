

<h1>Panier</h1>

@foreach($panier as $id => $item)
    <p>
        {{ $item['nom'] }} - 
        {{ $item['quantite'] }} x {{ $item['prix'] }} €
    </p>
@endforeach

<a href="/reservation">Valider la commande</a>