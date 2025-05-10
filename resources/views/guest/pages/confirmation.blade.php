
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> ForBest</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
	<link rel="icon" href="{{ asset('assets/adminPanel/images/Forbest-favicon-01.png') }}" type="image/jpg">  
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/plugins/jquery.countdown.css')}}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skins/skin-demo-13.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/demos/demo-13.css')}}" rel="stylesheet">
</head>

<body>

	@include('guest/partials.header')

    <div class="page-wrapper">
    



    <main class="main">
   
        <div class="container mt-5">
            <div class="text-center mb-4">
                <h1>Order Confirmation</h1>
                <p>Thank you for your order!</p>
            </div>
    
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h2>Order Details</h2>
                    {{-- <p><strong>Order ID:</strong> {{ $commande->id }}</p> --}}
                    <p><strong>Customer Name:</strong> {{ $commande->first_name }} {{ $commande->last_name }}</p>
                    <p><strong>Email:</strong> {{ $commande->email }}</p>
                    <p><strong>Phone:</strong> {{ $commande->phone }}</p>
                    <p><strong>Address:</strong> 
                        {{ $commande->street_address }},
                         {{ $commande->town_city }},
                          {{ $commande->state_county }}, 
                          {{ $commande->country }}</p>
                </div>
            </div>
            <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                            <td>{{ $ligne->product->current_sale_price }} DH</td>
                            <td>{{ $ligne->qte }}</td>
                            <td>{{ $commande->getTotal() }} DH</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
    
            {{-- <div class="card">
                <div class="card-body">
                    <h3>Ordered Items</h3>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                                        <td>{{ $ligne->product->current_sale_price }} DH</td>
                                        <td>{{ $ligne->qte }}</td>
                                        <td>{{ $commande->getTotal() }} DH</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
    
            <!-- You can add more details or formatting as per your requirements -->
        </div>
    
          

    </main>

        <!-- start .footer -->

	
    <script src= "{{asset('assets/js/jquery.min.js')}}"></script>

    <script src= "{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.hoverIntent.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.waypoints.min.js')}}"></script>

    <script src= "{{asset('assets/js/superfish.min.js')}}"></script>

    <script src= "{{asset('assets/js/owl.carousel.min.js')}}"></script>

    <script src= "{{asset('assets/js/bootstrap-input-spinner.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.plugin.min.js')}}"></script>

    <script src= "{{asset('assets/js/jquery.countdown.min.js')}}"></script>

    <!-- Main JS File -->
    <script src= "{{asset('assets/js/main.js')}}"></script>

    <script src= "{{asset('assets/js/demos/demo-13.js')}}"></script>

</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>