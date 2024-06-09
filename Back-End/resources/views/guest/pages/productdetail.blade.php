
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
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">

    
</head>

<body>

@include('guest/partials.header')
<div class="page-wrapper">
        <main class="main">
            <div class="page-content">
                <div class="product-details-top">
                    <div class="bg-light pb-5 mb-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                            <div class="container d-flex align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('forbest')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('product')}}">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Default</li>
                                </ol>
{{-- 
                                <nav class="product-pager ml-auto" aria-label="Product">
                                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                                        <i class="icon-angle-left"></i>
                                        <span>Prev</span>
                                    </a>

                                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                                        <span>Next</span>
                                        <i class="icon-angle-right"></i>
                                    </a>
                                </nav><!-- End .pager-nav -->
 --}}                                
                            </div><!-- End .container -->
                        </nav><!-- End .breadcrumb-nav -->
                        <div class="container">
                            <div class="product-gallery-carousel owl-carousel owl-full owl-nav-dark">
                                <figure class="product-gallery-image">
                                    <!-- Display the main image from the Product table -->
                                    <img src="{{ asset($productdetail->image_path) }}" data-zoom-image="{{ asset($productdetail->image_path) }}" alt="product image">
                                </figure><!-- End .product-gallery-image -->
                                
                                <!-- Loop through related images from the ProductImage table -->
                                @foreach($productdetail->productImage as $image)
                                    <figure class="product-gallery-image">
                                        <img src="{{ asset($image->image) }}" data-zoom-image="{{ asset($image->image) }}" alt="product image">
                                    </figure><!-- End .product-gallery-image -->
                                @endforeach
                            </div><!-- End .owl-carousel -->
                        </div><!-- End .container -->
                    </div><!-- End .bg-light pb-5 -->

                    <div class="product-details product-details-centered product-details-separator">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="product-title">{{ $productdetail->name }}</h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                        @php
										// Initialize the original price
										$originalPrice = $productdetail->current_sale_price;
							
										// Calculate the discounted price based on discount type
										if ($productdetail->discount_type == 1) { // Percentage discount
											$discountedPrice = $originalPrice - ($originalPrice * ($productdetail->discount / 100));
											$discountLabel = $productdetail->discount . '% off';
										} else if ($productdetail->discount_type == 0) { // Fixed discount
											$discountedPrice = $originalPrice - $productdetail->discount;
											$discountLabel = number_format(($productdetail->discount / $originalPrice) * 100, 2) . '% off';
										} else {
											$discountedPrice = $originalPrice;
											$discountLabel = null;
										}
									    @endphp
                                    	@if ($discountedPrice != $originalPrice)
                                        <span class="new-price">{{ number_format($discountedPrice, 2) }}</span>
                                        <span class="old-price">Was {{ number_format($originalPrice, 2) }}  HD</span>
                                        @else
                                        <span class="old-price"> {{ number_format($originalPrice, 2) }}  HD</span>
                                        @endif 
                                    </div><!-- End .product-price -->
                                    <div class="product-content">
                                        <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero.</p>
                                    </div><!-- End .product-content -->

                                    <div class="details-filter-row details-row-size">
                                        <label>Color:</label>

                                        <div class="product-nav product-nav-dots">
                                            <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #e8c97a;"><span class="sr-only">Color name</span></a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .details-filter-row -->

                                    <div class="details-filter-row details-row-size mb-md-1">
                                        <label>Size:</label>

                                        <div class="product-size">
                                            <a href="#" title="Small">S</a>
                                            <a href="#" title="Medium" class="active">M</a>
                                            <a href="#" title="Large" class="disabled">L</a>
                                            <a href="#" title="Extra Large">XL</a>
                                        </div><!-- End .product-size -->

                                        <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                    </div><!-- End .details-filter-row -->
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <div class="product-details-action">
                                        <div class="details-action-col">
                                            <div class="product-details-quantity">
                                                <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                            </div><!-- End .product-details-quantity -->

                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .details-action-col -->

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                        </div><!-- End .details-action-wrapper -->
                                    </div><!-- End .product-details-action -->

                                    <div class="product-details-footer details-footer-col">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            @php
                                               $id = $productdetail->productCategory->id
                                            @endphp
                                            <a href="{{ route('product.category', ['id' => $id]) }}">{{ $productdetail->productCategory->name }}</a>,
                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .product-details -->
                </div><!-- End .product-details-top -->

                <div class="container">
                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ count($productdetail->reviews) }})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    {{ $productdetail->description }}
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                            <h6>Reviews ({{ count($productdetail->reviews) }})</h6>
                            @foreach($productdetail->reviews as $r)
                            <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">by : {{ $r->user->name }} </a></h4>
                                                <p> {{ $r->rate }}</p>

                                                <span class="review-date">{{ $r->created_at->diffForHumans() }}</span>
                                            </div><!-- End .col -->
                                            <div class="col">

                                                <div class="review-content">
                                                    <p>{{ $r->content }}</p>
                                                </div><!-- End .review-content -->

                                           
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->
                                    @endforeach
                                    <div class="review-form">
        <h4>Add Your Review</h4>
        <form action="{{ route('forbest.review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productdetail->id }}">
            <div class="form-group">
                <label for="rate">Your Rating:</label>
                <select  max="5" min="1" name="rate" id="rate" class="form-control">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <div class="form-group">
                <label for="content">Your Review:</label>
                <textarea name="content" id="content" class="form-control" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
        </div><!-- End .review-form -->
    </div><!-- End .reviews -->


                                </div><!-- End .reviews -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->
                </div><!-- End .container -->
                
                <div class="container">
                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>

                        @foreach($productList as $key=>$product)
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
                            <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                                <div class="product-body">
                                    <div class="product-cat">
                                        @php 
                                          $id = $product->productCategory->id
                                        @endphp
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
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">( 1 Reviews )</span>
                                    </div><!-- End .rating-container -->
                                </div>
                            </a><!-- End .product-body -->
                        </div><!-- End .product -->
                        @endforeach
                    </div><!-- End .owl-carousel -->
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
    <script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>

    <!-- Main JS File -->
    <script src= "{{asset('assets/js/main.js')}}"></script>
    <script src= "{{asset('assets/js/demos/demo-13.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    
</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>