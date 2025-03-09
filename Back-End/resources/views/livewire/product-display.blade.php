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
            {{-- Include the Livewire ProductDisplay component --}}
            <div class="toolbox-layout">
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
                <a href="javascript:void(0);" wire:click="switchLayout('list')" class="btn-layout {{ $layout == 'list' ? 'active' : '' }}">
                    <svg width="16" height="10">
                        <rect x="0" y="0" width="4" height="4" />
                        <rect x="6" y="0" width="10" height="4" />
                        <rect x="0" y="6" width="4" height="4" />
                        <rect x="6" y="6" width="10" height="4" />
                    </svg>
                </a>
            </div>
            {{-- Include the Livewire ProductDisplay component --}}
            <!-- End .toolbox-layout -->
            </div><!-- End .toolbox-right -->
        </div><!-- End .toolbox -->
        <div>
            @if($layout === 'list')
                            {{-- Display products in a grid --}}
                            <div class="products mb-3">
                                @php
                                // Number of products per page
                                $productsPerPage = 6;
                            
                                // Get the current page from query parameters, default to 1
                                $currentPage = request()->get('page', 1);
                            
                                // Get the minimum and maximum price from query parameters
                                $minPrice2 = request()->get('min_price', 0);
                                $maxPrice2 = request()->get('max_price', PHP_INT_MAX);
                            
                                // Filter the products based on the price range
                                $filteredProducts = $productList->filter(function($product) use ($minPrice2, $maxPrice2) {
                                    return $product->current_sale_price >= $minPrice2 && $product->current_sale_price <= $maxPrice2;
                                });
                            
                                // Calculate the total number of pages
                                $totalPages = ceil($filteredProducts->count() / $productsPerPage);
                            
                                // Slice the product list to get the products for the current page
                                $currentProducts = $filteredProducts->forPage($currentPage, $productsPerPage);
                                @endphp
                                @foreach($currentProducts as $key=>$product)
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
                    
                                <div class="product product-list">
                                    <div class="row">
                                        <div class="col-6 col-lg-3">
                                            <figure class="product-media">
                                                @if($product->unit_type  >= 1 )
                                                   <span class="product-label label-new">{{ $product->unit_type }} OFF</span>
                                                @endif
                                                <a  href="{{ route('productdetail', ['id' => $product->id]) }}">
                                                    <img src="{{ asset($product->image_path) }}"  alt="Product image" class="product-image">
                                                </a>
                                            </figure><!-- End .product-media -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->
                    
                                        <div class="col-6 col-lg-3 order-lg-last">
                                            <div class="product-list-action">
                                                <div class="product-price">
                                                    @if ($product->previous_wholesale_price != $product->current_sale_price)
                                                        <span class="new-price">{{ number_format($product->current_sale_price, 0) }}</span>
                                                        <sm class="old-price">Was {{ number_format($product->previous_wholesale_price, 0) }} DH</sm>
                                                    @else
                                                        <span class="old-price"> {{ number_format($product->previous_wholesale_price, 0) }}  DH</span>
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
                                                {{-- <form action="/user/order/store" method="post">
                                                    @csrf
                                                    <input type="hidden" name="idproduct" id="idproduct" class="form-control" value="{{$product->id}}">
                                                    <input type="hidden" name="qte" id="qte" class="form-control" value="1" required>
                                                    <button class="btn-product btn-cart" type="submit"><span>add to cart hhhh</span></button>
                                                </form>   --}}
                                                
                                                <a href="#" class="btn-product btn-cart" wire:click.prevent="addToCart({{ $product->id }}, 1)">
                                                    <span>add to cart</span>
                                                </a>
                                                                                         
                                            </div><!-- End .product-list-action -->
                                        </div><!-- End .col-sm-6 col-lg-3 -->
                    
                                        <div class="col-lg-6">
                                            <div class="product-body product-action-inner">
                                                {{-- <a href="#" class="btn-product btn-wishlist" title="Add to wishlist"><span>add to wishlist</span></a> --}}
                                                <button type="button" wire:click="add('{{ $product->id }}')"  class="btn-product-icon btn-wishlist btn-expandable"><span>Add to Wishlist</span></button>
                                                <div class="product-cat">
                                                    @php
                                                        $id = $product->productCategory->id
                                                    @endphp
                                                    <a href="{{ route('product.category', ['id' => $id]) }}">{{ $product->productCategory->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title">
                                                    @php
                                                    // Specify the desired length and use Str directly
                                                    $name = $product->name;
                                                    $limit_name = 50; // Limit to 100 characters
                                                    @endphp
                                                    <a href="{{ route('productdetail', ['id' => $product->id]) }}">{{ \Illuminate\Support\Str::limit($name, $limit_name, '') }} 
                                                    @if(\Illuminate\Support\Str::length($name) > $limit_name)
                                                        <a href="{{ route('productdetail', ['id' => $product->id]) }}" class="more-link">...</a>
                                                    @endif
                                                    </a></h3><!-- End .product-title -->
                    
                                                <div class="product-content">
                                                    @php
                                                        // Specify the desired length and use Str directly
                                                        $description = $product->description;
                                                        $limit = 100; // Limit to 100 characters
                                                    @endphp

                                                    <p>
                                                        {{ \Illuminate\Support\Str::limit($description, $limit, '') }} 
                                                        @if(\Illuminate\Support\Str::length($description) > $limit)
                                                            <a href="{{ route('productdetail', ['id' => $product->id]) }}" class="more-link">More</a>
                                                        @endif
                                                    </p>
                                                </div><!-- End .product-content -->
                                                @if($product->productImage->isNotEmpty()) 
                                                    <div class="product-nav product-nav-thumbs">
                                                        @foreach($product->productImage as $image)
                                                            <a href="{{ route('productdetail', ['id' => $product->id]) }}" class="{{ $loop->first ? 'active' : '' }}">
                                                                <img src="{{ asset($image->image) }}" alt="product image">
                                                            </a>
                                                        @endforeach
                                                    </div><!-- End . product-nav -->
                                                @endif
                                                
                                            </div><!-- End .product-body -->
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .product -->
                                @endforeach
                            </div><!-- End .products -->
                    
                            @php
                            // Preserve the layout in pagination links
                            $prevPage = max(1, $currentPage - 1);
                            $nextPage = min($totalPages, $currentPage + 1);
                            @endphp
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                    <a class="page-link page-link-prev" href="?page={{ $prevPage }}&layout={{ $layout }}" aria-label="Previous" tabindex="-1" aria-disabled="{{ $currentPage == 1 ? 'true' : 'false' }}">
                                        <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                    </a>
                                </li>
                                
                                @for($i = 1; $i <= $totalPages; $i++)
                                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                        <a class="page-link" href="?page={{ $i }}&layout={{ $layout }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                
                                <li class="page-item-total">of {{ $totalPages }}</li>
                                
                                <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                    <a class="page-link page-link-next" href="?page={{ $nextPage }}&layout={{ $layout }}" aria-label="Next">
                                        Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                
            @else
                            {{-- Display products in a vertical list --}}
                            <div class="products mb-3">
                                <div class="row justify-content-center">
                                    @php
                                    // Number of products per page
                                    $productsPerPage = 12;
                                
                                    // Get the current page from query parameters, default to 1
                                    $currentPage = request()->get('page', 1);
                                
                                    // Get the minimum and maximum price from query parameters
                                    $minPrice2 = request()->get('min_price', 0);
                                    $maxPrice2 = request()->get('max_price', PHP_INT_MAX);
                                
                                    // Filter the products based on the price range
                                    $filteredProducts = $productList->filter(function($product) use ($minPrice2, $maxPrice2) {
                                        return $product->current_sale_price >= $minPrice2 && $product->current_sale_price <= $maxPrice2;
                                    });
                                
                                    // Calculate the total number of pages
                                    $totalPages = ceil($filteredProducts->count() / $productsPerPage);
                                
                                    // Slice the product list to get the products for the current page
                                    $currentProducts = $filteredProducts->forPage($currentPage, $productsPerPage);
                                @endphp
                                
                                
                            
                                    @foreach($currentProducts as $key=>$product)
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                @if($product->unit_type  >= 1 )
                                                   <span class="product-label label-new">{{ $product->unit_type }} OFF</span>
                                                @endif
                                                <a href="{{ route('productdetail', ['id' => $product->id]) }}">
                                                    <img src="{{ asset($product->image_path) }}"  alt="Product image" class="product-image">
                                                </a>
                            
                                                <div class="product-action-vertical">
                                                    <button type="button" wire:click="add('{{ $product->id }}')" class="btn-product-icon btn-wishlist btn-expandable"><span>Add to Wishlist</span></button>
                                                </div>
                                                <div class="product-action">
                                                    <a href="#" class="btn-product btn-cart" wire:click.prevent="addToCart({{ $product->id }}, 1)">
                                                        <span>add to cart</span>
                                                    </a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->
                            
                                            <div class="product-body">
                                                @php
                                                    $id = $product->productCategory->id;
                                                @endphp
                                                <div class="product-cat">
                                                    <a href="{{ route('product.category', ['id' => $id]) }}">{{ $product->productCategory->name }}</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title">
                                                    @php
                                                    // Specify the desired length and use Str directly
                                                    $name = $product->name;
                                                    $limit_name = 25 // Limit to 100 characters
                                                    @endphp
                                                    <a href="{{ route('productdetail', ['id' => $product->id]) }}">{{ \Illuminate\Support\Str::limit($name, $limit_name, '') }} 
                                                    @if(\Illuminate\Support\Str::length($name) > $limit_name)
                                                        <a href="{{ route('productdetail', ['id' => $product->id]) }}" class="more-link">..</a>
                                                    @endif
                                                    </a>
                                                </h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    @if ($product->previous_wholesale_price != $product->current_sale_price)
                                                    <span class="new-price">{{ number_format($product->current_sale_price, 0) }}</span>
                                                    <sm class="old-price">Was {{ number_format($product->previous_wholesale_price, 0) }} DH</sm>
                                                     @else
                                                    <span class="old-price"> {{ number_format($product->previous_wholesale_price, 0) }}  DH</span>
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
                                                @if($product->productImage->isNotEmpty()) 
                                                    <div class="product-nav product-nav-thumbs">
                                                        @foreach($product->productImage as $image)
                                                            <a href="{{ route('productdetail', ['id' => $product->id]) }}" class="{{ $loop->first ? 'active' : '' }}">
                                                                <img src="{{ asset($image->image) }}" alt="product image">
                                                            </a>
                                                        @endforeach
                                                    </div><!-- End . product-nav -->
                                                @endif
                                            </div><!-- End .product-body -->
                                            
                                            <!-- End .product-body -->
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
            @endif
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
                            <div class="filter-item">
                                <ul>
                                    <li>
                                        <a wire:click="filterByCategory" href="#">
                                            All
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- End .filter-item -->
                            @foreach($category as $key => $categorylist)
                            <div class="filter-item">
                                <ul>
                                    <li>
                                        <a wire:click="filterByCategory('{{ $categorylist->id }}')" href="#">
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
                        <div class="filter-items">
                            <div class="filter-item">
                                <ul>
                                    <li>
                                        <a wire:click="filterByBrand" href="#">All</a>
                                    </li>
                                </ul>
                            </div><!-- End .filter-item -->
                        </div><!-- End .filter-items -->
                        @foreach($brandList as $key=>$brand)
                        <div class="filter-items">
                            <div class="filter-item">
                                <ul>
                                    <li>
                                        <a wire:click="filterByBrand('{{ $brand->id }}')" href="#">{{ $brand->name }}</a>
                                    </li>
                                </ul>
                            </div><!-- End .filter-item -->
                        </div><!-- End .filter-items -->
                        @endforeach
                        
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3.002 9.75Q3 10.337 3 11v2c0 3.75 0 5.625.955 6.939a5 5 0 0 0 1.106 1.106C6.375 22 8.251 22 12 22s5.625 0 6.939-.955a5 5 0 0 0 1.106-1.106C21 18.625 21 16.749 21 13v-2q0-.663-.002-1.25h-3.352a2.75 2.75 0 0 1-2.646 2H9a2.75 2.75 0 0 1-2.646-2zm.019-1.5h3.333A2.75 2.75 0 0 1 9 6.25h6a2.75 2.75 0 0 1 2.646 2h3.333c-.055-2.01-.248-3.245-.934-4.189a5 5 0 0 0-1.106-1.106C17.625 2 15.749 2 12 2s-5.625 0-6.939.955A5 5 0 0 0 3.955 4.06c-.686.944-.88 2.178-.934 4.189"/><path fill="currentColor" d="M7.75 9c0-.69.56-1.25 1.25-1.25h6a1.25 1.25 0 1 1 0 2.5H9c-.69 0-1.25-.56-1.25-1.25"/></svg>
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5" class="">
                        Price
                    </a>
                </h3><!-- End .widget-title -->
            
                <div class="collapse show" id="widget-5" style="">
                    <div class="widget-body">
                        <div class="filter-price">
                            <div class="filter-price-text">
                                Price Range: 
                                <span id="filter-price-range">${{ $minPrice }} - ${{ $maxPrice }}</span>
                            </div>>
                            
                            <div id="price-slider" 
                            wire:ignore
                            x-data="{}"
                            x-init="
                               noUiSlider.create($refs.slider, {
                                   start: [{{ $minPrice }}, {{ $maxPrice }}],
                                   connect: true,
                                   range: {
                                       'min': 0,
                                       'max': 1000
                                   },
                                   tooltips: true,
                                   format: {
                                       to: function(value) {
                                           return '$' + parseInt(value);
                                       },
                                       from: function(value) {
                                           return Number(value.replace('$', ''));
                                       }
                                   }
                               });
                       
                               $refs.slider.noUiSlider.on('set', function(values, handle) {
                                   // Emit the event with the new price range
                                   Livewire.emit('priceUpdated', values[0], values[1]);
                               });
                       
                               // Update the price range display dynamically
                               $refs.slider.noUiSlider.on('update', function(values, handle) {
                                   document.getElementById('filter-price-range').textContent = '$' + values[0] + ' - $' + values[1];
                               });
                            ">
                           <div x-ref="slider" class="noUi-target noUi-ltr noUi-horizontal"></div>
                       </div>
                        </div><!-- End .filter-price -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div>
            
        </div><!-- End .sidebar sidebar-shop -->
    </aside><!-- End .col-lg-3 -->
</div>

