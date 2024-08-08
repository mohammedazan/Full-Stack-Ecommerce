<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <p><strong>Date of Purchase:</strong> {{ $commande->created_at }}</p>
    <p><strong>Customer Name:</strong> {{ $commande->first_name }} {{ $commande->last_name }}</p>
    <p><strong>Email:</strong> {{ $commande->email }}</p>
    <p><strong>Phone:</strong> {{ $commande->phone }}</p>
    <p><strong>Address:</strong><br>
        @if($commande->city)
            {{ $commande->city->name }},
        @endif
        {{ $commande->street_address }},<br>
        {{ $commande->postcode }}
    </p>
    <p><strong>Company Name:</strong> {{ $commande->company_name }}</p>
    <p><strong>Products Ordered:</strong></p>
    <ul>
        @foreach($commande->lignecommande as $lc)
            <li>{{ $lc->product->name }} (Quantity: {{ $lc->qte }})</li>
        @endforeach
    </ul>
</body>
</html>
