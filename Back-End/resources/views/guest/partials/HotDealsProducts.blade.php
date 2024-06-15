   <!-- start .HotDealsProducts -->
   <div class="bg-light pt-3 pb-5">
                <div class="container">
                    <div class="heading heading-flex heading-border mb-3">
                        <div class="heading-left">
                            <h2 class="title">Our Products</h2><!-- End .title -->
                        </div><!-- End .heading-left -->

                       <div class="heading-right">
                            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" {{-- id="hot-all-link" data-toggle="tab" --}} href="{{ route('forbest') }}"  role="tab" aria-controls="hot-all-tab" aria-selected="true">All</a>
                                </li>
                                @php
                                // Shuffle the category collection and take the first six
                                $randomCategories = $category->shuffle()->take(4);
                                @endphp
                                @foreach($randomCategories as $key => $categorylist)
                                @php
                                   $id  = $categorylist->id
                                @endphp
                                <li class="nav-item">
                                    <a class="nav-link"  href="{{ route('forbest', ['id' => $id]) }}"  role="tab" aria-controls="hot-elec-tab" aria-selected="false">
                                        {{ $categorylist->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                       </div><!-- End .heading-right -->
                    </div><!-- End .heading -->

                    <div class="tab-content tab-content-carousel">
                        <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
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
                            
                                <div class="product">
                                    <figure class="product-media">
                                        @if($discountLabel >= 1)
                                            <span class="product-label label-sale">{{ $discountLabel }}</span>
                                        @endif
                                        <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                                            <img src="{{ asset($product->image_path) }}" alt="Product image" class="product-image">
                                        </a>
                            
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        </div><!-- End .product-action-vertical -->
                            
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
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
                                            @if ($discountedPrice != $originalPrice)
                                            <span class="new-price">{{ number_format($discountedPrice, 2) }}</span>
                                            <span class="old-price">Was {{ number_format($originalPrice, 2) }}  HD</span>
                                            @else
                                            <span class="old-price"> {{ number_format($originalPrice, 2) }}  HD</span>
                                            @endif 
                                        </div><!-- End .product-price -->
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">( 2 Reviews )</span>
                                        </div><!-- End .rating-container -->
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
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .container -->
            </div>
            <!-- End .HotDealsProducts -->
            <!-- End .bg-light pt-5 pb-5 -->