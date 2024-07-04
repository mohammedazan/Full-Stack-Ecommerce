
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
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
         
						
						<!-- End .checkout-discount -->

						
            			<form action="{{ route('order.place') }}" method="POST">
                         @csrf
						 <input type="hidden" name="commande" value="{{$commande->id}}">
		                	<div class="row">
		                		<div class="col-lg-9">
		                			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>First Name *</label>
		                						<input name="first_name" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Last Name *</label>
		                						<input name="last_name" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

										<label>Country *</label>
										<select name="country" id="country" class="form-control" required>
											<option value="Morocco">Select Country</option>
										</select>
							
										<label>Town / City *</label>
										<select name="town_city" id="town_city" class="form-control" required>
											<option value="">Select City</option>
										</select>
							
										<label>State / County *</label>
										<select name="state_county" id="state_county" class="form-control" required>
											<option value="">Select Province</option>
										</select>

	            						<label>Street address *</label>
	            						<input name="street_address" type="text" class="form-control" placeholder="House number and Street name" required>


										
	            						{{-- <div class="row">
		                					<div class="col-sm-6">
		                						<label>Town / City *</label>
		                						<input name="town_city" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 --> --}}


											


		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Postcode / ZIP *</label>
		                						<input name="postcode" type="text" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Phone *</label>
		                						<input name="phone" type="tel" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

	                					<label>Email address *</label>
	        							<input name="email" type="email" class="form-control" required>

	        			
		                		</div><!-- End .col-lg-9 -->
		                		<aside class="col-lg-3">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->
										
		                				<table class="table table-summary">
											
		                					<thead>
		                						<tr>
		                							<th>Name</th>
		                							{{-- <th>Qte</th> --}}
		                							<th>price</th>
		                						</tr>
		                					</thead>
											@foreach($commande->lignecommande ?? [] as $lc)
		                					<tbody data-product-id="{{ $lc->id }}">
		                						<tr class="summary-subtotal">

													<td><a href="{{ route('productdetail', ['id' => $lc->product->id]) }}">{{ $lc->product->name }}</a></td>
													{{-- <td>{{$p->name}}</td> --}}
													<td>{{ $lc->product->current_sale_price }} DH</td>
													</tr>
												
												<!-- End .summary-subtotal -->
		                						{{-- <tr>
		                							<td>Shipping:</td>
		                							<td>Free shipping</td>
		                						</tr> --}}
		                						{{-- <tr class="summary-total">
		                							<td>Total:</td>
		                							<td>$160.00</td>
		                						</tr><!-- End .summary-total --> --}}
												@endforeach

		                					</tbody>
		                				</table><!-- End .table table-summary -->

										<div class="form-group">
											<label for="payment_method">Select Payment Method:</label>
											<select name="payment_method" id="payment_method" class="form-control">
												<option value="paypal">PayPal</option>
												{{-- <option value="visa">Visa Card</option> --}}
											</select>
										</div>

		                				<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Place Order</span>
		                					<span class="btn-hover-text">Proceed to Checkout</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
		<script>
			// Array of African countries
			const africanCountries = [
				"Morocco", "Algeria", "Angola", "Benin", "Botswana", "Burkina Faso", 
				"Burundi", "Cabo Verde", "Cameroon", "Central African Republic", 
				"Chad", "Comoros", "Congo", "Djibouti", "Egypt", "Equatorial Guinea", 
				"Eritrea", "Eswatini", "Ethiopia", "Gabon", "Gambia", "Ghana", 
				"Guinea", "Guinea-Bissau", "Ivory Coast", "Kenya", "Lesotho", "Liberia", 
				"Libya", "Madagascar", "Malawi", "Mali", "Mauritania", "Mauritius", 
				"Mozambique", "Namibia", "Niger", "Nigeria", "Rwanda", "Sao Tome and Principe", 
				"Senegal", "Seychelles", "Sierra Leone", "Somalia", "South Africa", 
				"South Sudan", "Sudan", "Tanzania", "Togo", "Tunisia", "Uganda", "Zambia", "Zimbabwe"
			];
	
			// Array of Moroccan cities
			const moroccanCities = [
				"Casablanca", "Fez", "Tangier", "Marrakesh", "Salé", "Meknes", "Rabat",
				"Oujda", "Kenitra", "Agadir", "Tetouan", "Safi", "Mohammedia", "Khouribga",
				"El Jadida", "Beni Mellal", "Ait Melloul", "Nador", "Dar Bouazza", "Taza",
				"Settat", "Larache", "Ksar El Kebir", "Khemisset", "Guelmim", "Berrechid",
				"Oued Zem", "Inezgane", "Taroudant", "Fquih Ben Salah", "Taourirt", "Berkane",
				"Sidi Slimane", "Errachidia", "Guercif", "Youssoufia", "Sidi Kacem", "Khenifra",
				"Benslimane", "Al Hoceima", "Tifelt", "Dakhla", "Tan-Tan", "Sidi Ifni",
				"Zagora", "Essaouira", "Ouarzazate", "Alnif", "Azrou", "Midelt", "Tiznit",
				"Boudnib", "Figuig", "Mhamid El Ghizlane", "Rissani", "Asilah"
			];
	
			// Array of Moroccan provinces
			const moroccanProvinces = [
				"Chaouia-Ouardigha", "Doukkala-Abda", "Fès-Boulemane", "Gharb-Chrarda-Béni Hssen",
				"Grand Casablanca", "Guelmim-Es Semara", "Laâyoune-Boujdour-Sakia El Hamra",
				"Marrakech-Tensift-Al Haouz", "Meknès-Tafilalet", "Oriental", "Rabat-Salé-Zemmour-Zaer",
				"Souss-Massa-Drâa", "Tadla-Azilal", "Tanger-Tétouan", "Taza-Al Hoceima-Taounate"
			];
	
			// Function to populate a select element with an array of options
			function populateSelect(elementId, optionsArray) {
				const selectElement = document.getElementById(elementId);
				optionsArray.forEach(option => {
					const opt = document.createElement('option');
					opt.value = option;
					opt.textContent = option;
					selectElement.appendChild(opt);
				});
			}
	
			// Populate the country select with African countries
			populateSelect('country', africanCountries);
			
	
			// Populate the city select with Moroccan cities
			populateSelect('town_city', moroccanCities);
	
			// Populate the province select with Moroccan provinces
			populateSelect('state_county', moroccanProvinces);
		</script>
        <!-- start .footer -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->

    @include('guest/partials.register')

    @include('guest/partials.login')
	@include('guest/partials.mobile-menu')
	
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