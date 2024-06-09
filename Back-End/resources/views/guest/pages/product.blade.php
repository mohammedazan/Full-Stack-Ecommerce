
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> about</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
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
    <div class="page-wrapper">
    @include('guest/partials.header')
    <main class="main">

            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('forbest')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
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
												$number_c = 12;
											}
										@endphp
										@endforeach
                						Showing <span> {{ $number_c }} of {{ $number_f }}</span> Products
                					</div><!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control">
												<option value="popularity" selected="selected">Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div><!-- End .toolbox-sort -->
                		{{--        <div class="toolbox-layout">
                						<a href="category-list.html" class="btn-layout">
                							<svg width="16" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="10" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="10" height="4" />
                							</svg>
                						</a>

                						<a href="category-2cols.html" class="btn-layout">
                							<svg width="10" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                							</svg>
                						</a>

                						<a href="category.html" class="btn-layout active">
                							<svg width="16" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="12" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                								<rect x="12" y="6" width="4" height="4" />
                							</svg>
                						</a>

                						<a href="category-4cols.html" class="btn-layout">
                							<svg width="22" height="10">
                								<rect x="0" y="0" width="4" height="4" />
                								<rect x="6" y="0" width="4" height="4" />
                								<rect x="12" y="0" width="4" height="4" />
                								<rect x="18" y="0" width="4" height="4" />
                								<rect x="0" y="6" width="4" height="4" />
                								<rect x="6" y="6" width="4" height="4" />
                								<rect x="12" y="6" width="4" height="4" />
                								<rect x="18" y="6" width="4" height="4" />
                							</svg>
                						</a>
                					</div>
						--}} <!-- End .toolbox-layout -->
                				</div><!-- End .toolbox-right -->
                			</div><!-- End .toolbox -->

							<div class="products mb-3">
								<div class="row justify-content-center">
									@php
										// Number of products per page
										$productsPerPage = 12;
							
										// Calculate the total number of pages
										$totalPages = ceil($productList->count() / $productsPerPage);
							
										// Get the current page from query parameters, default to 1
										$currentPage = request()->get('page', 1);
							
										// Slice the product list to get the products for the current page
										$currentProducts = $productList->forPage($currentPage, $productsPerPage);
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
									@endphp
							
									<div class="col-6 col-md-4 col-lg-4">
										<div class="product product-7 text-center">
											<figure class="product-media">
												@if($discountLabel)
												<span class="product-label label-new">{{ $discountLabel }}</span>
												@endif
												<a href="{{ route('productdetail', ['id' => $product->id]) }}">
													<img src="{{ asset($product->image_path) }}"  alt="Product image" class="product-image">
												</a>
							
												<div class="product-action-vertical">
													<a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
													<a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
													<a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
												</div><!-- End .product-action-vertical -->
							
												<div class="product-action">
													<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
												</div><!-- End .product-action -->
											</figure><!-- End .product-media -->
							
											<div class="product-body">
												@php
												    $id = $product->productCategory->id
												@endphp
												<div class="product-cat">
													<a href="{{ route('product.category', ['id' => $id]) }}">{{ $product->productCategory->name }}</a>
												</div><!-- End .product-cat -->
												<h3 class="product-title"><a href="{{ route('productdetail', ['id' => $product->id]) }}">{{ $product->name }}</a></h3><!-- End .product-title -->
												<div class="product-price">
													@if ($discountedPrice != $originalPrice)
													<span class="new-price">{{ number_format($discountedPrice, 2) }}</span>
													<span class="old-price">Was {{ number_format($originalPrice, 2) }}  HD</span>
													@else
													<span class="old-price"> {{ number_format($originalPrice, 2) }}  HD</span>
													@endif 
												</div><!-- End .product-price -->
												<div class="ratings-container">
													<div class="ratings">
														<div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
													</div><!-- End .ratings -->
													<span class="ratings-text">( 2 Reviews )</span>
												</div><!-- End .rating-container -->
											</div><!-- End .product-body -->
										</div><!-- End .product -->
									</div><!-- End .col-sm-6 col-lg-4 -->
									@endforeach
								</div><!-- End .row -->
							</div><!-- End .products -->
							
							<nav aria-label="Page navigation">
								<ul class="pagination justify-content-center">
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
															<a href="{{ route('product.category', ['id' => $categorylist->id]) }}" >
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
															<a href="{{ route('product.brand', ['id' => $brand->id]) }}">{{ $brand->name }}</a>
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

                                                <div id="price-slider"></div><!-- End #price-slider -->
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
        <!-- start .footer -->
        @include('guest/partials.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
	@include('guest/partials.signin_register')


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