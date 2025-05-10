<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <!-- Include any necessary CSS styles -->
    <style>
        /* Define your CSS styles for the invoice */
    </style>
</head>
<body>
    <div class="invoice">
        <h2>Invoice #{{ $commande->id }}</h2>
        <p>Name: {{ $commande->first_name }} {{ $commande->last_name }}</p>
        <!-- Add more details as needed -->
    </div>
</body>
</html>
