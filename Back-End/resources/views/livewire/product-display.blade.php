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
        {{-- Include the Livewire ProductDisplay component --}}
        <div class="toolbox-layout">
            <a href="javascript:void(0);" wire:click="switchLayout('list')" class="btn-layout {{ $layout == 'list' ? 'active' : '' }}">
                <svg width="16" height="10">
                    <rect x="0" y="0" width="4" height="4" />
                    <rect x="6" y="0" width="10" height="4" />
                    <rect x="0" y="6" width="4" height="4" />
                    <rect x="6" y="6" width="10" height="4" />
                </svg>
            </a>
        
            <a href="javascript:void(0);" wire:click="switchLayout('grid')" class="btn-layout {{ $layout == 'grid' ? 'active' : '' }}">
                <svg width="16" height="10">
                    <rect x="0" y="0" width="4" height="4" />
                    <rect x="6" y="0" width="4" height="4" />
                    <rect x="12" y="0" width="4" height="4" />
                    <rect x="0" y="6" width="4" height="4" />
                    <rect x="6" y="6" width="4" height="4" />
                    <rect x="12" y="6" width="4" height="4" />
                </svg>
            </a>
        </div>
        {{-- Include the Livewire ProductDisplay component --}}
        <!-- End .toolbox-layout -->
        </div><!-- End .toolbox-right -->
    </div><!-- End .toolbox -->
    <div>
        @if($layout === 'list')
            {{-- Display products in a vertical list --}}
            <div class="products mb-3">
                <div class="row justify-content-center">
                    @php
                    // Number of products per page
                    $productsPerPage = 12;
                
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
                    @endphp
            
                    <div class="col-6 col-md-4 col-lg-4">
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                @if($discountLabel  >= 1 )
                                <span class="product-label label-new">{{ $discountLabel }}</span>
                                @endif
                                <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                                    <img src="{{ asset($product->image_path) }}"  alt="Product image" class="product-image">
                                </a>
            
                                <div class="product-action-vertical">
                                    <form action="{{ route('wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn-product-icon btn-wishlist btn-expandable"><span>Add to Wishlist</span></button>
                                    </form>	
            
                                </div>
                                <!-- End .product-action-vertical -->
                                    <form action="/user/order/store" method="post">
                                        @csrf
                                        <input type="hidden" name="idproduct" id="idproduct" class="form-control" value="{{$product->id}}">
                                        <input type="hidden" name="qte" id="qte" class="form-control" value="1" required>
                                        <div  class="product-action"><button class="btn-product btn-cart" title="Add to cart" type="submit"><span>add to cart</span></button></div>
                                    </form> 
                                    {{-- <a href="#" class="btn-product btn-cart"><span>add to cart</span></a> --}}
                            </figure><!-- End .product-media -->
            
                            <div class="product-body">
                                @php
                                    $id = $product->productCategory->id;
                                @endphp
                                <div class="product-cat">
                                    <a href="{{ route('product.category', ['id' => $id]) }}">{{ $product->productCategory->name }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title">
                                    <a href="{{ route('productdetail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                    @if ($product->previous_wholesale_price != $product->current_sale_price)
                                        <span class="new-price">{{ $product->current_sale_price }}</span>
                                        <sm class="old-price">Was {{ $product->previous_wholesale_price  }}  DH</sm>
                                    @else
                                        <span class="old-price">{{ $product->current_sale_price }}  DH</span>
                                    @endif
                                </div><!-- End .product-price -->
                                @if (isset($product->reviewsCount) && $product->reviewsCount > 0)
                                    <div class="ratings-container">
                                        <div>
                                            @for ($i = 0; $i < $product->avgRating; $i++)
                                                @if ($i < floor($product->avgRating))
                                                    <i class="fas fa-star" style="color: #ffc107;"></i>
                                                @else
                                                    @if ($product->avgRating - $i > 0.5)
                                                        <i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
                                                    @else
                                                        <i class="far fa-star" style="color: #ffc107;"></i>
                                                    @endif
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ratings-text">({{ $product->reviewsCount }} Reviews)</span>
                                    </div><!-- End .ratings-container -->
                                @else
                                    <p class="ratings"></p>
                                @endif
                                {{--<div class="product-nav product-nav-thumbs">
                                    @foreach($product->productImage as $image)
                                    <a href="#" class="active">
                                        <img src="{{ asset($image->image) }}"  alt="product desc">
                                    </a>
                                    @endforeach
                                </div><!-- End .product-nav -->  --}}  
                            </div><!-- End .product-body -->
                            
                            <!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-lg-4 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .products -->
        @else
            {{-- Display products in a grid --}}
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
    
                                <a  href="{{ route('productdetail', ['id' => $product->id]) }}">
                                    <img src="{{ asset($product->image_path) }}"  alt="Product image" class="product-image">
                                </a>
                            </figure><!-- End .product-media -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
    
                        <div class="col-6 col-lg-3 order-lg-last">
                            <div class="product-list-action">
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
                                </div>
                                
                                <!-- End .ratings-container -->
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
                                </form>  
                                {{-- <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>  --}}                                         
                            </div><!-- End .product-list-action -->
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
        @endif
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
    </div>    
    {{-- <nav aria-label="Page navigation">
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
    </nav> --}}
</div><!-- End .col-lg-9 -->