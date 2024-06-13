
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
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">

    

<!-- Add Font Awesome for stars -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
                        </div>
                    </nav>
                    <div class="container">
                        <div class="product-gallery-carousel owl-carousel owl-full owl-nav-dark">
                            <figure class="product-gallery-image">
                                <img src="{{ asset($productdetail->image_path) }}" data-zoom-image="{{ asset($productdetail->image_path) }}" alt="product image">
                            </figure>
                            @foreach($productdetail->productImage as $image)
                                <figure class="product-gallery-image">
                                    <img src="{{ asset($image->image) }}" data-zoom-image="{{ asset($image->image) }}" alt="product image">
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="product-details product-details-centered product-details-separator">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="product-title">{{ $productdetail->name }}</h1>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                    </div>
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div>
                                <div class="product-price">
                                    @php
                                    $originalPrice = $productdetail->current_sale_price;
                                    if ($productdetail->discount_type == 1) {
                                        $discountedPrice = $originalPrice - ($originalPrice * ($productdetail->discount / 100));
                                        $discountLabel = $productdetail->discount . '% off';
                                    } else if ($productdetail->discount_type == 0) {
                                        $discountedPrice = $originalPrice - $productdetail->discount;
                                        $discountLabel = number_format(($productdetail->discount / $originalPrice) * 100, 2) . '% off';
                                    } else {
                                        $discountedPrice = $originalPrice;
                                        $discountLabel = null;
                                    }
                                    @endphp
                                    @if ($discountedPrice != $originalPrice)
                                        <span class="new-price">{{ number_format($discountedPrice, 2) }}</span>
                                        <span class="old-price">Was {{ number_format($originalPrice, 2) }} HD</span>
                                    @else
                                        <span class="old-price">{{ number_format($originalPrice, 2) }} HD</span>
                                    @endif
                                </div>
                                <div class="product-content">
                                    <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero.</p>
                                </div>
                                <div class="details-filter-row details-row-size">
                                    <label>Color:</label>
                                    <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #e8c97a;"><span class="sr-only">Color name</span></a>
                                    </div>
                                </div>
                                <div class="details-filter-row details-row-size mb-md-1">
                                    <label>Size:</label>
                                    <div class="product-size">
                                        <a href="#" title="Small">S</a>
                                        <a href="#" title="Medium" class="active">M</a>
                                        <a href="#" title="Large" class="disabled">L</a>
                                        <a href="#" title="Extra Large">XL</a>
                                    </div>
                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="/user/order/store" method="post">
                                    @csrf
                                    <input type="hidden" name="idproduct" id="idproduct" class="form-control" value="{{$productdetail->id}}">
                                    <div class="product-details-action">
                                        <div class="details-action-col">
                                            <div class="product-details-quantity">
                                                <input type="number" name="qte" id="qte" class="form-control" value="1" required>
                                            </div>
                                            <button class="btn-product btn-cart" type="submit"><span>add to cart</span></button>
                                        </div>
                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                        </div>
                                    </div>
                                </form>
                                <div class="product-details-footer details-footer-col">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        <a href="{{ route('product.category', ['id' => $productdetail->productCategory->id]) }}">{{ $productdetail->productCategory->name }}</a>,
                                    </div>
                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                            <h6>Reviews ({{ count($productdetail->reviews) }})</h6>
                            @foreach($productdetail->reviews as $r)
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">by: {{ $r->user->name }}</a></h4>
                                        @for ($i = 0; $i < $r->rate; $i++)
                                            <i class="fas fa-star" style="color: #ffc107;"></i>
                                        @endfor
                                        <br>
                                        <span class="review-date">{{ $r->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="col">
                                        <div class="review-content">
                                            <p>{{ $r->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="review-form">
                                <h4>Add Your Review</h4>
                                <form action="{{ route('forbest.review.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $productdetail->id }}">
                                    <div class="form-group">
                                        <label for="rate">Your Rating:</label>
                                        <select name="rate" id="rate" class="form-control" max="5" min="1">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Your Review:</label>
                                        <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
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
    <script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>

    <!-- Main JS File -->
    <script src= "{{asset('assets/js/main.js')}}"></script>
    <script src= "{{asset('assets/js/demos/demo-13.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    
</body>


<!-- molla/index-13.html  22 Nov 2019 09:59:31 GMT -->
</html>