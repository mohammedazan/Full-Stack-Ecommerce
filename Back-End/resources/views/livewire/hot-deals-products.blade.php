   <div class="bg-light pt-3 pb-5">
                <div class="container">
                    <div class="heading heading-flex heading-border mb-3">
                        <div class="heading-left">
                            <h2 class="title">Our Products</h2><!-- End .title -->
                        </div><!-- End .heading-left -->
                            <div class="heading-right">
                                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ is_null($activeCategory) ? 'active' : '' }}" wire:click="CategoryFilter()" role="tab" aria-controls="hot-all-tab" aria-selected="{{ is_null($activeCategory) ? 'true' : 'false' }}">All</a>
                                    </li>
                                    @foreach($category as $categorylist)
                                        @php
                                        $id  = $categorylist->id;
                                        @endphp
                                        <li class="nav-item">
                                            <a class="nav-link {{ $activeCategory == $id ? 'active' : '' }}" wire:click="CategoryFilter('{{ $id }}')" role="tab" aria-controls="hot-elec-tab" aria-selected="{{ $activeCategory == $id ? 'true' : 'false' }}">
                                                {{ $categorylist->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                       <!-- End .heading-right -->
                    </div><!-- End .heading -->

                    <div class="tab-content tab-content-carousel">
                        <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                            <div id="filtered-carousel" class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
                            data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
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
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                                @foreach($productList as $key=>$product)
                                @php
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
                            
                                <div class="product">
                                    <figure class="product-media">
                                        @if($product->unit_type  >= 1 )
                                        <span class="product-label label-sale">{{ $product->unit_type }} OFF</span>
                                        @endif
                                        <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                                            <img src="{{ asset($product->image_path) }}" alt="Product image" class="product-image">
                                        </a>
                            
                                        <div class="product-action-vertical">
                                            <form action="{{ route('wishlist.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn-product-icon btn-wishlist btn-expandable"><span>Add to Wishlist</span></button>
                                            </form>
                                              {{-- <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> --}}
                                            {{-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a> --}}
                                        </div><!-- End .product-action-vertical -->
                                        <form action="/user/order/store" method="post">
                                                @csrf
                                                <input type="hidden" name="idproduct" id="idproduct" class="form-control" value="{{$product->id}}">
                                                <input type="hidden" name="qte" id="qte" class="form-control" value="1" required>
                                                <div class="product-action"><button class="btn-product btn-cart" title="Add to cart" type="submit"><span>add to cart</span></button></div>
                                        </form> 

                                            {{-- <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a> --}}
                                    </figure><!-- End .product-media -->
                                <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                                    <div class="product-body">
                                        @php
                                        $id = $product->productCategory->id
                                        @endphp

                                        <div class="product-cat">
                                            <a href="{{ route('product.category', ['id' => $id]) }}">{{ $product->productCategory->name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('productdetail', ['id' => $product->id]) }}">{{ $product->name }}</a></h3><!-- End .product-title -->

                                        <div class="product-price">
                                            @if ($product->previous_wholesale_price != $product->current_sale_price)
                                            <span class="new-price">{{ $product->current_sale_price }}</span>
                                            <sm class="old-price">Was {{ $product->previous_wholesale_price  }}  DH</sm>
                                            @else
                                            <span class="old-price">{{ $product->current_sale_price }}  DH</span>
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
                                        @if($product->color)
                                        <div class="product-nav product-nav-dots">
                                            <a href="#" class="active" style="background: {{ $product->color }}"><span class="sr-only">Color name</span></a>
                                        </div><!-- End .product-nav -->
                                        @endif

                                    {{--     <div class="product-nav product-nav-thumbs">
                                            @foreach($product->productImage as $image)
                                            <a href="#" class="active">
                                                <img src="{{ asset($image->image) }}"  alt="product desc">
                                            </a>
                                            @endforeach
                                        </div><!-- End .product-nav -->
                                     --}}    
                                    </div><!-- End .product-body -->
                                </a>
                                </div><!-- End .product -->
                            @endforeach
                            <script>
                                window.addEventListener('contentChanged', event => {
                                    const owl = $('#filtered-carousel'); // Target the specific carousel
                                    if (owl.length > 0) {
                                        // Destroy the existing carousel to prevent duplication
                                        $(owl).trigger('destroy.owl.carousel');
                                        
                                        // Remove any leftover Owl Carousel classes and elements
                                        $(owl).html($(owl).find('.owl-stage-outer').html()).removeClass('owl-loaded owl-drag');
                                        
                                        // Reinitialize the Owl Carousel with the correct settings
                                        $(owl).owlCarousel({
                                            nav: false,
                                            dots: true,
                                            margin: 20,
                                            loop: false,
                                            responsive: {
                                                0: {
                                                    items: 2
                                                },
                                                480: {
                                                    items: 2
                                                },
                                                768: {
                                                    items: 3
                                                },
                                                992: {
                                                    items: 4
                                                },
                                                1280: {
                                                    items: 5,
                                                    nav: true
                                                }
                                            }
                                        });
                                    }
                                });
                            </script>
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .container -->
            </div>
            <!-- End .HotDealsProducts -->
            <!-- End .bg-light pt-5 pb-5 -->

