
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
    
    <main class="main">

            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a  href="{{ route('forbest') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="container">
					@if($wishlistItems->isEmpty())
					<div class="alert alert-info text-center">
						Your wishlist is empty. <a href="{{ route('product') }}" class="btn btn-primary">Start Shopping</a>
					</div>
			       	@else
					<table class="table table-wishlist table-mobile">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Stock Status</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
							@foreach($wishlistItems as $wishlistItem)
							<tr>
								<td class="product-col">
									<div class="product">
										<figure class="product-media">
											<a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}">
                                                <img src="{{ asset($wishlistItem->product->image_path) }}" alt="{{ $wishlistItem->product->name }}">
                                            </a>
										</figure>

										<h3 class="product-title">
                                            <a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}">{{ $wishlistItem->product->name }}</a>
										</h3><!-- End .product-title -->
									</div><!-- End .product -->
								</td>
								<td class="price-col">
                                    @if ($wishlistItem->product->discount_type == 1)
                                        <span class="new-price">${{ number_format($wishlistItem->product->current_sale_price * (1 - $wishlistItem->product->discount / 100), 2) }}</span>
                                        <span class="old-price">${{ number_format($wishlistItem->product->current_sale_price, 2) }}</span>
                                    @else
                                        <span class="new-price">${{ number_format($wishlistItem->product->current_sale_price, 2) }}</span>
                                    @endif
                                </td>
																
								<td class="stock-col">
									@if($wishlistItem->product->available_quantity > 0)
									<span class="in-stock">In Stock</span>
								@else
									<span class="out-of-stock">Out of Stock</span>
								@endif
								</td>
								<td class="action-col">
                                    <div class="dropdown">
									<button class="btn btn-block btn-outline-primary-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-list-alt"></i>Select Options
                                    </button>

                                    <div class="dropdown-menu">
                                        <a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}"  class="dropdown-item" href="#">
											Add to cart </a>
											<a  href="{{ route('product') }}" class="dropdown-item" href="#">
												Start Shopping </a>
											
                                      </div>
                                    </div>
								</td>
								<td class="remove-col">
									<form action="{{ route('wishlist.remove', ['id' => $wishlistItem->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove"><i class="icon-close"></i></button>
                                    </form>
								</td>
							</tr>
							@endforeach

						
						</tbody>
					</table><!-- End .table table-wishlist -->
	            	<div class="wishlist-share">
	            		<div class="social-icons social-icons-sm mb-2">
	            			<label class="social-label">Share on:</label>
	    					<a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
	    					<a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
	    					<a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
	    					<a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
	    					<a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
	    				</div><!-- End .soial-icons -->
	            	</div><!-- End .wishlist-share -->
					@endif

            	</div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->



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