
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
    <link rel="stylesheet"  href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}" >


    <!-- Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skins/skin-demo-13.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/demos/demo-13.css')}}" rel="stylesheet">
    
	<!-- Add Font Awesome for stars -->

<!-- Include Font Awesome and Toastr CSS -->


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

            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('forbest')}}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{route('product')}}">All Products</a></li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox" style="background-color: #ffffff">
                				<div class="toolbox-left">
                					<div class="toolbox-info">
                                    @php 
										$number_f = 0;
										$number_c = 0;
									@endphp
									
									@foreach($productList as $key=>$product)
										@php
											$number_f++;
											if($number_f <= 12) {
												$number_c = $number_f;
											} else {
												$number_c = 6;
											}
										@endphp
										@endforeach
                						Showing <span> {{ $number_c }} of {{ $number_f }}</span> Products
                					</div><!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                				<div class="toolbox-right">
                					<div class="toolbox-layout">
                						<a href="{{ route('product_list')}}" class="btn-layout active">
                							<svg width="16" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="10" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="10" height="4" />
                							</svg>
                						</a>

                						<a href="{{ route('product')}}" class="btn-layout">
                							<svg width="10" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                							</svg>
                						</a>
                					</div><!-- End .toolbox-layout -->
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->

                            <div class="products mb-3">
                                @php
                                // Number of products per page
                                $productsPerPage = 6;
                            
                                // Get the current page from query parameters, default to 1
                                $currentPage = request()->get('page', 1);
                            
                                // Get the minimum and maximum price from query parameters
                                $minPrice = request()->get('min_price', 0);
                                $maxPrice = request()->get('max_price', PHP_INT_MAX);
                            
                                // Filter the products based on the price range
                                $filteredProducts = $productList->filter(function($product) use ($minPrice, $maxPrice) {
                                    return $product->current_sale_price >= $minPrice && $product->current_sale_price <= $maxPrice;
                                });
                            
                                // Calculate the total number of pages
                                $totalPages = ceil($filteredProducts->count() / $productsPerPage);
                            
                                // Slice the product list to get the products for the current page
                                $currentProducts = $filteredProducts->forPage($currentPage, $productsPerPage);
                                @endphp
								@foreach($currentProducts as $key=>$product)
								@php
										// Initialize the original price
										$originalPrice = $product->current_sale_price;
							
										// Calculate the discounted price based on discount type
										if ($product->discount_type == 1) { // Percentage discount
											$discountedPrice = $originalPrice - ($originalPrice * ($product->discount / 100));
											$discountLabel = $product->discount . '% off';
										} else if ($product->discount_type == 0) { // Fixed discount
											$discountedPrice = $originalPrice - $product->discount;
											$discountLabel = number_format(($product->discount / $originalPrice) * 100, 2) . '% off';
										} else {
											$discountedPrice = $originalPrice;
											$discountLabel = null;
										}

									  // Get average rating and reviews count
									  $avgRating = $product->avgRating;
            $reviewsCount = $product->reviewsCount;
            
            // Calculate full stars and half star
            $fullStars = floor($avgRating); // Number of full stars (whole number part)
            $halfStar = ceil($avgRating - $fullStars); // Whether to display a half star
            
            // Calculate full stars and half star
            $fullStars = floor($avgRating); // Number of full stars (whole number part)
            $halfStar = ceil($avgRating - $fullStars); // Whether to display a half star
									@endphp

                                <div class="product product-list">
                                    <div class="row">
                                        <div class="col-6 col-lg-3">
                                            <figure class="product-media">
												@if($discountLabel)
												<span class="product-label label-new">{{ $discountLabel }}</span>
												@endif
                                                <a  href="{{ route('productdetail', ['id' => $product->id]) }}">
                                                    <img src="{{ asset($product->image_path) }}"  alt="Product image" class="product-image">
                                                </a>
                                            </figure><!-- End .product-media -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-6 col-lg-3 order-lg-last">
                                            <div class="product-list-action">
                                                <div class="product-price">
													@if ($discountedPrice != $originalPrice)
													<span class="new-price">{{ number_format($discountedPrice, 2) }}</span>
													<span class="old-price">Was {{ number_format($originalPrice, 2) }}  DH</span>
													@else
													<span class="old-price"> {{ number_format($originalPrice, 2) }}  DH</span>
													@endif 
                                                </div><!-- End .product-price -->
												@if ($product->reviews->isNotEmpty())
												@php
													$avgRating = $product->reviews->avg('rate'); // Calculate average rating
													$fullStars = floor($avgRating); // Number of full stars
													$halfStar = ceil($avgRating - $fullStars); // Whether to display a half star
												@endphp
				
												<div class="ratings-container">
													<div class="">
														@for ($i = 0; $i < $fullStars; $i++)
															<i class="fas fa-star" style="color: #ffc107;"></i>
														@endfor
														@if ($halfStar)
															<i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
														
														@endif
													
													</div>
													<span class="ratings-text">({{ $reviewsCount}} Reviews)</span>
												</div><!-- End .ratings-container -->
												@else
												<p class="ratings">
                                            
												</p>
												@endif
                                                {{-- <div class="product-action">
                                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
													<a href="#" class="btn-product btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a>
                                                </div> --}}
												



												<!-- End .product-action -->

												
												<form action="/user/order/store" method="post">
													@csrf
													<input type="hidden" name="idproduct" id="idproduct" class="form-control" value="{{$product->id}}">
													<input type="hidden" name="qte" id="qte" class="form-control" value="1" required>
													<button class="btn-product btn-cart" type="submit"><span>add to cart</span></button>
												</form>                                            </div><!-- End .product-list-action -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->

                                        <div class="col-lg-6">
                                            <div class="product-body product-action-inner">
                                                {{-- <a href="#" class="btn-product btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a> --}}
													<form action="{{ route('wishlist.add') }}" method="POST">
														@csrf
														<input type="hidden" name="product_id" value="{{ $product->id }}">
														<button type="submit" class="btn-product-icon btn-wishlist btn-expandable"><span>Add to Wishlist</span></button>
													</form>												
													<div class="product-cat">
												@php
												    $id = $product->productCategory->id
												@endphp
                                                    <a href="{{ route('product.category', ['id' => $id]) }}">{{ $product->productCategory->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="{{ route('productdetail', ['id' => $product->id]) }}">{{ $product->name }}</a></h3><!-- End .product-title -->

                                                <div class="product-content">
                                                    <p> {{ $product->productCategory->note }}</p>
                                                </div><!-- End .product-content -->
                                                
                                                <div class="product-nav product-nav-thumbs">
													@foreach($product->productImage as $image)
                                                    <a href="#" class="active">
                                                        <img src="{{ asset($image->image) }}"  alt="product desc">
                                                    </a>
													@endforeach
                                                </div><!-- End .product-nav -->
                                            </div><!-- End .product-body -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .product -->
								@endforeach
                            </div><!-- End .products -->

                			<nav aria-label="Page navigation">
							    <ul class="pagination">
									@php
										// Calculate the previous and next page numbers
										$prevPage = max(1, $currentPage - 1);
										$nextPage = min($totalPages, $currentPage + 1);
									@endphp
							
									<li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
										<a class="page-link page-link-prev" href="?page={{ $prevPage }}" aria-label="Previous" tabindex="-1" aria-disabled="{{ $currentPage == 1 ? 'true' : 'false' }}">
											<span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
										</a>
									</li>
							
									@for($i = 1; $i <= $totalPages; $i++)
									<li class="page-item {{ $currentPage == $i ? 'active' : '' }}"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
									@endfor
							
									<li class="page-item-total">of {{ $totalPages }}</li>
							
									<li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
										<a class="page-link page-link-next" href="?page={{ $nextPage }}" aria-label="Next">
											Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
										</a>
									</li>
							    </ul>
							</nav>
                		</div><!-- End .col-lg-9 -->
						
                		<aside class="col-lg-3 order-lg-first">
                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Category
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count">
												@foreach($category as $key => $categorylist)
												<div class="filter-item">
													<ul>
														<li>
															<a href="{{ route('product_list.category', ['id' => $categorylist->id]) }}" >
																{{ $categorylist->name }}
															</a>
														</li>
													</ul>
												</div><!-- End .filter-item -->
												@endforeach
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						{{-- <div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
									        Size
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-2">
										<div class="widget-body">
											<div class="filter-items">
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-1">
														<label class="custom-control-label" for="size-1">XS</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-2">
														<label class="custom-control-label" for="size-2">S</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" checked id="size-3">
														<label class="custom-control-label" for="size-3">M</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" checked id="size-4">
														<label class="custom-control-label" for="size-4">L</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-5">
														<label class="custom-control-label" for="size-5">XL</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-6">
														<label class="custom-control-label" for="size-6">XXL</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->


        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
									        Colour
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-3">
										<div class="widget-body">
											<div class="filter-colors">
												<a href="#" style="background: #b87145;"><span class="sr-only">Color Name</span></a>
												<a href="#" style="background: #f0c04a;"><span class="sr-only">Color Name</span></a>
												<a href="#" style="background: #333333;"><span class="sr-only">Color Name</span></a>
												<a href="#" class="selected" style="background: #cc3333;"><span class="sr-only">Color Name</span></a>
												<a href="#" style="background: #3399cc;"><span class="sr-only">Color Name</span></a>
												<a href="#" style="background: #669933;"><span class="sr-only">Color Name</span></a>
												<a href="#" style="background: #f2719c;"><span class="sr-only">Color Name</span></a>
												<a href="#" style="background: #ebebeb;"><span class="sr-only">Color Name</span></a>
											</div><!-- End .filter-colors -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
								--}} 	

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-4">
										<div class="widget-body">
											@foreach($brandList as $key=>$brand)
											<div class="filter-items">
												<div class="filter-item">
													<ul>
														<li>
															<a href="{{ route('product_list.brand', ['id' => $brand->id]) }}">{{ $brand->name }}</a>
														</li>
													</ul>
												</div><!-- End .filter-item -->
											</div><!-- End .filter-items -->
											@endforeach
											
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
									        Price
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-5">
										<div class="widget-body">
											<div class="filter-price">
												<div class="filter-price-text">
													Price Range:
													<span id="filter-price-range"></span>
												</div><!-- End .filter-price-text -->
									
												<form id="price-filter-form" method="GET" action="{{ url()->current() }}">
													<input type="hidden" name="min_price" id="min_price" value="{{ request()->get('min_price', 0) }}">
													<input type="hidden" name="max_price" id="max_price" value="{{ request()->get('max_price', 10000) }}">
													<div id="price-slider"></div><!-- End #price-slider -->
												</form>
											</div><!-- End .filter-price -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
									
									
        						</div><!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				var priceSlider = document.getElementById('price-slider');
				var minPriceInput = document.getElementById('min_price');
				var maxPriceInput = document.getElementById('max_price');
				var filterPriceRange = document.getElementById('filter-price-range');
				var priceFilterForm = document.getElementById('price-filter-form');

				noUiSlider.create(priceSlider, {
					start: [{{ request()->get('min_price', 0) }}, {{ request()->get('max_price', 10000) }}],
					connect: true,
					range: {
						'min': 0,
						'max': 5000
					},
					step: 10,
					format: wNumb({
						decimals: 0,
						thousand: ','
					})
				});

				priceSlider.noUiSlider.on('update', function (values, handle) {
					minPriceInput.value = values[0].replace(/,/g, '');
					maxPriceInput.value = values[1].replace(/,/g, '');
					filterPriceRange.innerHTML = values[0]  + ' DH ' + ' - '+values[1] + ' DH ' ;
				});

				priceSlider.noUiSlider.on('change', function (values, handle) {
					// Submit the form automatically when the price range is changed
					priceFilterForm.submit();
				});
			});
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
    <script  src= "{{asset('assets/js/wNumb.js')}}" ></script>
	<script  src= "{{asset('assets/js/nouislider.min.js')}}" ></script>
		<!-- Main JS File -->



</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>