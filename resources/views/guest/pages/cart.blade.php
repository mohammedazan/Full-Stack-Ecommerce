
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


	
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<!-- Include jQuery and Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function(){
        // Toastr Initialization
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    });
</script>

</head>

<body>
    <div class="page-wrapper">
    
    @include('guest/partials.header')



	<main class="main">
		<nav aria-label="breadcrumb" class="breadcrumb-nav">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Shop</a></li>
					<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
				</ol>
			</div><!-- End .container -->
		</nav><!-- End .breadcrumb-nav -->
	
		<div class="page-content">
			<div class="cart">
				<div class="container">
					<div class="row">
						<div class="col-lg-9">
							<form action="{{ route('updatecart') }}" method="POST" id="cart-form">
								@csrf
								<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Name Product</th>
											<th>Product Img</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($commande->lignecommande ?? [] as $lc)
										<tr data-product-id="{{ $lc->id }}">
											<td>
												<h3 class="product-title">
													<a href="{{ route('productdetail', ['id' => $lc->product->id]) }}"><span>{{ $lc->product->name }}</span></a>
												</h3><!-- End .product-title -->
											</td>
											<td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="{{ route('productdetail', ['id' => $lc->product->id]) }}">
															<img src="{{ asset($lc->product->image_path) }}" alt="Product image">
														</a>
													</figure>
												</div><!-- End .product -->
											</td>
											<td class="price-col">{{ $lc->product->current_sale_price }} DH</td>
											<td class="quantity-col">
												<div class="cart-product-quantity">
													<input type="number" name="quantities[{{ $lc->id }}]" value="{{ $lc->qte }}" min="1" class="form-control quantity-input" data-price="{{ $lc->product->current_sale_price }}">
												</div><!-- End .cart-product-quantity -->
											</td>
											<td class="total-col">{{ $lc->product->current_sale_price * $lc->qte }} DH</td>
											<td class="remove-col"><a href="/user/lc/{{ $lc->id }}/destroy" class="btn-remove"><i class="icon-close"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</table><!-- End .table table-wishlist -->
							</form>
							
							<script>
								document.addEventListener('DOMContentLoaded', function() {
									const quantityInputs = document.querySelectorAll('.quantity-input');
									const shippingInputs = document.querySelectorAll('input[name="shipping"]');
									
									quantityInputs.forEach(input => {
										input.addEventListener('input', function() {
											const productRow = this.closest('tr');
											const price = parseFloat(this.getAttribute('data-price'));
											const quantity = parseInt(this.value);
											const totalCol = productRow.querySelector('.total-col');
											
											// Update total for the current product
											const total = price * quantity;
											totalCol.textContent = total + ' DH';
											
											// Update the overall cart subtotal and total
											updateCartTotal();
											
											// Automatically submit the form
											saveCartUpdates();
										});
									});
									
									shippingInputs.forEach(input => {
										input.addEventListener('change', function() {
											updateCartTotal();
											
											// Automatically submit the form
											saveCartUpdates();
										});
									});
									
									function updateCartTotal() {
										let cartSubtotal = 0;
										const totalCols = document.querySelectorAll('.total-col');
										totalCols.forEach(totalCol => {
											const total = parseFloat(totalCol.textContent.replace(' DH', ''));
											cartSubtotal += total;
										});
										
										document.getElementById('subtotal').textContent = cartSubtotal + ' DH';
										
										// Update the overall total including shipping
										updateTotal();
									}
									
									function updateTotal() {
										const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(' DH', ''));
										let shipping = 0;
										
										const selectedShipping = document.querySelector('input[name="shipping"]:checked');
										if (selectedShipping) {
											shipping = parseFloat(selectedShipping.value);
										}
										
										const total = subtotal + shipping;
										document.getElementById('total').textContent = total + ' DH';
									}
									
									function saveCartUpdates() {
										const form = document.getElementById('cart-form');
										form.submit();
									}
									
									// Call updateCartTotal on page load to ensure correct initial values
									updateCartTotal();
								});
							</script>
						</div><!-- End .col-lg-9 -->
						
						<aside class="col-lg-3">
							<form action="" method="">
								@csrf
								@if($commande)
								<input type="hidden" name="commande" value="{{ $commande->id }}">
								@endif
								<div class="summary summary-cart">
									<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->
									<table class="table table-summary">
										<tbody>
											<tr class="summary-subtotal">
												<td>Subtotal:</td>
												@if($commande)
												<td id="subtotal">{{ $commande->getTotal() }} DH</td>
												@endif
											</tr><!-- End .summary-subtotal -->
											<tr class="summary-shipping">
												<td>Shipping:</td>
												<td>&nbsp;</td>
											</tr>
											<tr class="summary-shipping-row">
												<td>
													<div class="custom-control custom-radio">
														<input type="radio" id="free-shipping" name="shipping" class="custom-control-input" value="0.00" onclick="updateTotal()">
														<label class="custom-control-label" for="free-shipping">Free Shipping</label>
													</div><!-- End .custom-control -->
												</td>
												<td>0.00DH</td>
											</tr>
											<!-- End .summary-shipping-row -->
											<tr class="summary-shipping-row">
												<td>
													<div class="custom-control custom-radio">
														<input type="radio" id="standard-shipping" name="shipping" class="custom-control-input" value="10.00" onclick="updateTotal()">
														<label class="custom-control-label" for="standard-shipping">Standard</label>
													</div><!-- End .custom-control -->
												</td>
												<td>10.00DH</td>
											</tr>
											<!-- End .summary-shipping-row -->
											<tr class="summary-shipping-row">
												<td>
													<div class="custom-control custom-radio">
														<input type="radio" id="express-shipping" name="shipping" class="custom-control-input" value="20.00" onclick="updateTotal()">
														<label class="custom-control-label" for="express-shipping">Express</label>
													</div><!-- End .custom-control -->
												</td>
												<td>20.00DH</td>
											</tr>
											<!-- End .summary-shipping-row -->
											{{-- <tr class="summary-shipping-estimate">
												<td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
												<td>&nbsp;</td>
											</tr> --}}
											<!-- End .summary-shipping-estimate -->
											<tr class="summary-total">
												<td>Total:</td>
												@if($commande)
												<td id="total">{{ $commande->getTotal() + 0 }} DH</td> <!-- Initial total without shipping -->
												@endif
											</tr><!-- End .summary-total -->
										</tbody>
									</table><!-- End .table table-summary -->
									<a href="/user/checkout" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
								</div><!-- End .summary -->
								<a href="{{ route('product_list')}}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
							</form>
						</aside><!-- End .col-lg-3 -->
					</div>
					
					
				</div><!-- End .container -->
			</div><!-- End .cart -->
		</div><!-- End .page-content -->
	</main><!-- End .main -->

    
   

        <!-- start .footer -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- End .mobile-menu-container -->
   
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
