<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Include your CSS files or styles here -->
</head>
<body>
    <div>

      
        <h1>Order Confirmation</h1>
        <p>Thank you for your order!</p>
        
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> {{ $commande->id }}</p>
        <p><strong>Customer Name:</strong> {{ $commande->first_name }} {{ $commande->last_name }}</p>
        <p><strong>Email:</strong> {{ $commande->email }}</p>
        <p><strong>Address:</strong> {{ $commande->street_address }}, {{ $commande->town_city }}, {{ $commande->state_county }}, {{ $commande->postcode }}, {{ $commande->country }}</p>
        
        <h3>Ordered Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commande->lignecommande as $ligne)
                    <tr>
                        <td>{{ $ligne->product->name }}</td>
                        <td>{{ $ligne->product->price }}</td>
                        <td>{{ $ligne->qte }}</td>
                        <td>{{ $ligne->product->price * $ligne->qte }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
        
        <!-- You can add more details or formatting as per your requirements -->
    </div>
    <!-- Include your JavaScript files or scripts here -->
</body>
</html>
