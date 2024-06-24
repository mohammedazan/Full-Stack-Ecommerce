<header class="header header-10 header-intro-clearance">
<div class="header-top">
    <div class="container">
        <div class="header-left">
            <a href="tel:#"><i class="icon-phone"></i>Call:
                @php
                    $ver = $CompanyInfo->shuffle()->take(1);
                @endphp
                @foreach ($ver as $key =>$Company )
                {{$Company->phone}}
            @endforeach</a>
        </div><!-- End .header-left -->

        <div class="header-right">
            <ul class="top-menu">
                <li>
                    <a href="#">Links</a>
                    <ul>
                        <li>
                        </li>
                        <li>   
                            <div class="header-dropdown">
                                <a href="#">English</a>
                                <div class="header-menu">
                                    <ul>
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">French</a></li>
                                        <li><a href="#">Spanish</a></li>
                                    </ul>
                                </div><!-- End .header-menu -->
                            </div><!-- End .header-dropdown -->
                        </li>
                        <li>
                            @guest
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#login-modal">Sign In</a>
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#register-modal">/Sign Up</a>
                                <!-- Sign In / Register -->
                                {{-- <a class="navbar-brand" href="{{ url('/') }}">Admin</a> --}}

                            @else
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('/user/profile') }}">Profile</a>
                                        <a class="dropdown-item" href="#">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    </div>
                                </div>
                            @endguest
                        </li>
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-top -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>


<div class="header-middle">
    <div class="container">
        <div class="header-left">
            <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
            </button>

            <a href="{{route('forbest')}}" class="logo">
                <img src="{{asset('assets/adminPanel')}}/images/Forbest-Logo-01.png" alt="Molla Logo" width="150" height="25">
            </a>
        </div><!-- End .header-left -->
    <div class="header-center">
        <div>
            <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="#" method="get" id="product-search-form">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
            <div id="search-results" class="search-results  header-search-extended " style="margin-top: -23px; overflow: hidden; "></div>
        </div><!-- End .header-center -->
    </div>    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
          .search-results {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            display: none; /* Start hidden */
          }
      
          .search-results a {
            display: block;
            padding: 8px;
            border-bottom: 1px solid #eee;
            color: #333;
            text-decoration: none;
          }
      
          .search-results a:hover {
            background-color: #f0f0f0;
          }
        </style>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
          $(document).ready(function() {
              $('#q').on('keyup', function() {
                  var query = $(this).val();
                  if (query.length > 2) {
                      console.log('Sending AJAX request with query:', query);
                      $.ajax({
                          url: "{{ route('product.search') }}",
                          type: "GET",
                          data: { q: query },
                          success: function(data) {
                              console.log('AJAX response:', data);
                              $('#search-results').html(data).show();
                              console.log('Search results should be visible now');
                          },
                          error: function(xhr, status, error) {
                              console.error('AJAX error:', error);
                          }
                      });
                  } else {
                      $('#search-results').html('').hide();
                  }
              });
          
              $(document).on('click', '.search-result-item', function() {
                  var productId = $(this).data('id');
                  // Construct the URL with query parameter
                  var url = "{{ url('productdetail') }}?id=" + productId;
                  window.location.href = url;
              });
          });
          </script>
                  
        <div class="header-right">
            <div class="header-dropdown-link">                <a href="{{route('wishlist')}}" class="wishlist-link">
                    <i class="icon-heart-o"></i>
                    <span class="wishlist-count">3</span>
                    <span class="wishlist-txt">
                        Wishlist</span>
                </a>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">2</span>
                        <span class="cart-txt">Cart</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Beige knitted elastic runner shoes</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $84.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/cart/product-1.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->

                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Blue utility pinafore denim dress</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $76.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/cart/product-2.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">$160.00</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="cart.html" class="btn btn-primary">View Cart</a>
                            <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div>
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-middle -->
{{--  
    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown show is-on" data-visible="true">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                        Browse Categories
                    </a>

                    <div class="dropdown-menu show">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                {{--  
                                    @php
                                        // Group subcategories by category
                                        $groupedSubcategories = $productSubcategory->groupBy('category_id');
                                    @endphp
                                
                                    @foreach($groupedSubcategories as $categoryId => $subcategories)
                                        @php
                                            // Get the category name from the first subcategory in the group
                                            $categoryName = $subcategories->first()->category->name;
                                            $categoryid = $subcategories->first()->category->id;
                                        @endphp
                                    <li class="megamenu-container">
                                        <a class="sf-with-ul" href="{{ route('product.category', ['id' => $categoryid]) }}">{{ $categoryName }}</a>
                                        <div class="megamenu" style="width:300px">
                                            <div class="row no-gutters">
                                                <div class="col-md-8">
                                                    <div class="menu-col">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                @foreach($subcategories as $subcategory)
                                                                    <div class="menu-title" style="width:270px">
                                                                        <a href="{{ route('product.subcategory', ['id' => $subcategory->id]) }}">{{ $subcategory->name }}</a>
                                                                    </div><!-- End .menu-title -->
                                                                @endforeach
                                                            </div><!-- End .col-md-6 -->
                                                        </div><!-- End .row -->
                                                    </div><!-- End .menu-col -->
                                                </div><!-- End .col-md-8 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .megamenu -->
                                    </li>
                                    <ul class="menu-vertical sf-arrows">
                                    <li class="megamenu-container">
                                            <a class="sf-with-ul" href="#"> ProductCategory 1 </a>
                                            <div class="megamenu">
                                                <div class="menu-col">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="menu-title">Product SubCategory 1 </div><!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="#">Product </a></li>
                                                                <li><a href="#">Product </a></li>
                                                                <li><a href="#">Product </a></li>
                                                                <li><a href="#">Product </a></li>
                                                                <li><a href="#">Product </a></li>
                                                                <li><a href="#">Show more </a></li>
                                                            </ul>
                                                        </div><!-- End .col-md-4 -->

                                                        <div class="col-md-4">
                                                            <div class="menu-title">Product SubCategory 2 </div><!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="#">Product 1 </a></li>
                                                                <li><a href="#">Product 2  </a></li>
                                                                <li><a href="#">Product 3 </a></li>
                                                                <li><a href="#">Product 4 </a></li>
                                                                <li><a href="#">Product 5  </a></li>
                                                                <li><a href="#">Show more </a></li>
                                                            </ul>
                                                        </div><!-- End .col-md-4 -->

                                                        <div class="col-md-4">
                                                            <div class="menu-title">Product SubCategory 3 </div><!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="#">Product 1 </a></li>
                                                                <li><a href="#">Product 2  </a></li>
                                                                <li><a href="#">Product 3 </a></li>
                                                                <li><a href="#">Product 4 </a></li>
                                                                <li><a href="#">Product 5  </a></li>
                                                                <li><a href="#">Show more </a></li>
                                                            </ul>
                                                        </div><!-- End .col-md-4 -->
                                                    </div><!-- End .row -->

                                                    <div class="row menu-banners">
                                                        <div class="col-md-4">
                                                            <div class="banner">
                                                                <a href="#">
                                                                    <img src="assets/images/demos/demo-13/menu/Product.jpg" alt="image">
                                                                </a>
                                                            </div><!-- End .banner -->
                                                        </div><!-- End .col-md-4 -->

                                                        <div class="col-md-4">
                                                            <div class="banner">
                                                                <a href="#">
                                                                    <img src="assets/images/demos/demo-13/menu/Product .jpg" alt="image">
                                                                </a>
                                                            </div><!-- End .banner -->
                                                        </div><!-- End .col-md-4 -->

                                                        <div class="col-md-4">
                                                            <div class="banner">
                                                                <a href="#">
                                                                    <img src="assets/images/demos/demo-13/menu/Product .jpg" alt="image">
                                                                </a>
                                                            </div><!-- End .banner -->
                                                        </div><!-- End .col-md-4 -->
                                                    </div><!-- End .row -->
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .megamenu -->
                                        </li>
                                @endforeach
                                
                                @foreach($categoriesWithProducts2 as $category)
                                <li class="megamenu-container">
                                    <a class="sf-with-ul" href="#">{{ $category->name }}</a>
                                    <div class="megamenu">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $relatedSubcategories = $productSubcategory2->where('category_id', $category->id)->take(3);
                                                @endphp
            
                                                @foreach($relatedSubcategories as $subcategory)
                                                    <div class="col-md-4">
                                                        <div class="menu-title">{{ $subcategory->name }}</div><!-- End .menu-title -->
                                                        <ul>
                                                            @php
                                                                $relatedProducts = $productList2->where('subcategory_id', $subcategory->id)->take(5);
                                                            @endphp
                                                            @foreach($relatedProducts as $product)
                                                                <li><a href="#">{{ $product->name }}</a></li>
                                                            @endforeach
                                                            <li><a href="#">Show more</a></li>
                                                        </ul>
                                                    </div><!-- End .col-md-4 -->
                                                @endforeach
                                            </div><!-- End .row -->
            
                                            <div class="row menu-banners">
                                                @foreach($relatedSubcategories as $subcategory)
                                                    <div class="col-md-4">
                                                        <div class="banner">
                                                            @php
                                                                $bannerProduct = $productList2->where('subcategory_id', $subcategory->id)->first();
                                                            @endphp
                                                            @if($bannerProduct)
                                                                <a href="#">
                                                                    <img src="{{ asset($bannerProduct->image_path) }}" alt="{{ $bannerProduct->name }}" style="width: 100%; height: 100%;">
                                                                </a>
                                                            @endif
                                                        </div><!-- End .banner -->
                                                    </div><!-- End .col-md-4 -->
                                                @endforeach
                                            </div><!-- End .row -->
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .megamenu -->
                                </li>
                            @endforeach                  
                            </ul><!-- End .menu-vertical -->
                        </nav><!-- End .side-nav -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .category-dropdown -->
            </div><!-- End .col-lg-3 -->
            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">
                            
                            <a href="{{ url('/forbest') }}"  class="sf-with-ul">Home</a>

                        </li>
                        <li>
                            <a href="category.html" class="sf-with-ul">Shop</a>

                            <div class="megamenu megamenu-md">
                            <div class="row no-gutters">
                                <div class="col-md-8">
                                    <div class="menu-col">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="menu-title">Shop with sidebar</div><!-- End .menu-title -->
                                                <ul>
                                                    <li><a href="category-list.html">Shop List</a></li>
                                                    <li><a href="category-2cols.html">Shop Grid 2 Columns</a></li>
                                                    <li><a href="category.html">Shop Grid 3 Columns</a></li>
                                                    <li><a href="category-4cols.html">Shop Grid 4 Columns</a></li>
                                                    <li><a href="category-market.html"><span>Shop Market<span class="tip tip-new">New</span></span></a></li>
                                                </ul>

                                                <div class="menu-title">Shop no sidebar</div><!-- End .menu-title -->
                                                <ul>
                                                    <li><a href="category-boxed.html"><span>Shop Boxed No Sidebar<span class="tip tip-hot">Hot</span></span></a></li>
                                                    <li><a href="category-fullwidth.html">Shop Fullwidth No Sidebar</a></li>
                                                </ul>
                                            </div><!-- End .col-md-6 -->

                                            <div class="col-md-6">
                                                <div class="menu-title">Product Category</div><!-- End .menu-title -->
                                                <ul>
                                                    <li><a href="product-category-boxed.html">Product Category Boxed</a></li>
                                                    <li><a href="product-category-fullwidth.html"><span>Product Category Fullwidth<span class="tip tip-new">New</span></span></a></li>
                                                </ul>
                                                <div class="menu-title">Shop Pages</div><!-- End .menu-title -->
                                                <ul>
                                                    <li><a href="cart.html">Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="dashboard.html">My Account</a></li>
                                                    <li><a href="#">Lookbook</a></li>
                                                </ul>
                                            </div><!-- End .col-md-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .menu-col -->
                                </div><!-- End .col-md-8 -->

                                <div class="col-md-4">
                                    <div class="banner banner-overlay">
                                        <a href="category.html" class="banner banner-menu">
                                            <img src="assets/images/menu/banner-1.jpg" alt="Banner">

                                            <div class="banner-content banner-content-top">
                                                <div class="banner-title text-white">Last <br>Chance<br><span><strong>Sale</strong></span></div><!-- End .banner-title -->
                                            </div><!-- End .banner-content -->
                                        </a>
                                    </div><!-- End .banner banner-overlay -->
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .megamenu megamenu-md -->
                        </li>
                        <li>
                            <a href="product.html" class="sf-with-ul">Product</a>

                            <div class="megamenu megamenu-sm">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="menu-col">
                                            <div class="menu-title">Product Details</div><!-- End .menu-title -->
                                            <ul>
                                                <li><a href="product.html">Default</a></li>
                                                <li><a href="product-centered.html">Centered</a></li>
                                                <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                                                <li><a href="product-gallery.html">Gallery</a></li>
                                                <li><a href="product-sticky.html">Sticky Info</a></li>
                                                <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                                                <li><a href="product-fullwidth.html">Full Width</a></li>
                                                <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                                            </ul>
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="banner banner-overlay">
                                            <a href="category.html">
                                                <img src="assets/images/menu/banner-2.jpg" alt="Banner">

                                                <div class="banner-content banner-content-bottom">
                                                    <div class="banner-title text-white">New Trends<br><span><strong>spring 2019</strong></span></div><!-- End .banner-title -->
                                                </div><!-- End .banner-content -->
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-md-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-sm -->
                        </li>
                        <li>
                            <a href="#" class="sf-with-ul">Pages</a>

                            <ul>
                                <li>
                                    <a href="{{ url('/about') }}"  class="sf-with-ul">About</a>
<!-- 
                                    <ul>
                                        <li><a href="about.html">About 01</a></li>
                                    </ul> -->

                                </li>
                                <li>
                                    <a href="{{ url('/contact') }}"  class="sf-with-ul">Contact</a>

                                    <!-- <ul>
                                        <li><a href="contact.html">Contact 01</a></li>
                                    </ul> -->
                                </li>
                                <!-- <li><a href="login.html">Login</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="404.html">Error 404</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li> -->
                            </ul>
                        </li>

                        <li>
                                    <a href="{{ url('/blogall') }}"  class="sf-with-ul">Blog</a>

                        </li>

                        <li>
                            <a href="elements-list.html" class="sf-with-ul">Elements</a>

                            <ul>
                                <li><a href="elements-products.html">Products</a></li>
                                <li><a href="elements-typography.html">Typography</a></li>
                                <li><a href="elements-titles.html">Titles</a></li>
                                <li><a href="elements-banners.html">Banners</a></li>
                                <li><a href="elements-product-category.html">Product Category</a></li>
                                <li><a href="elements-video-banners.html">Video Banners</a></li>
                                <li><a href="elements-buttons.html">Buttons</a></li>
                                <li><a href="elements-accordions.html">Accordions</a></li>
                                <li><a href="elements-tabs.html">Tabs</a></li>
                                <li><a href="elements-testimonials.html">Testimonials</a></li>
                                <li><a href="elements-blog-posts.html">Blog Posts</a></li>
                                <li><a href="elements-portfolio.html">Portfolio</a></li>
                                <li><a href="elements-cta.html">Call to Action</a></li>
                                <li><a href="elements-icon-boxes.html">Icon Boxes</a></li>
                            </ul>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .col-lg-9 -->
            <div class="header-right">
                <i class="la la-lightbulb-o"></i><p>Clearance Up to 30% Off</span></p>
            </div>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
    --}}
    
    <div class="header-bottom sticky-header">
        <div class="container">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                        Browse Categories 
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                    @php
                                        // Group subcategories by category
                                        $groupedSubcategories = $productSubcategory->groupBy('category_id');
                                    @endphp
                                
                                    @foreach($groupedSubcategories as $categoryId => $subcategories)
                                        @php
                                            // Get the category name from the first subcategory in the group
                                            $categoryName = $subcategories->first()->category->name;
                                            $categoryid = $subcategories->first()->category->id;
                                        @endphp
                                    <li class="megamenu-container">
                                        <a class="sf-with-ul" href="{{ route('product.category', ['id' => $categoryid]) }}">{{ $categoryName }}</a>
                                        <div class="megamenu" style="width:300px">
                                            <div class="row no-gutters">
                                                <div class="col-md-8">
                                                    <div class="menu-col">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                @foreach($subcategories as $subcategory)
                                                                    <div class="menu-title" style="width:270px">
                                                                        <a href="{{ route('product.subcategory', ['id' => $subcategory->id]) }}">{{ $subcategory->name }}</a>
                                                                    </div><!-- End .menu-title -->
                                                                @endforeach
                                                            </div><!-- End .col-md-6 -->
                                                        </div><!-- End .row -->
                                                    </div><!-- End .menu-col -->
                                                </div><!-- End .col-md-8 -->
                                            </div><!-- End .row -->
                                        </div><!-- End .megamenu -->
                                    </li>
                                    @endforeach
                            </ul>
                        </nav>
                    </div>
                </div><!-- End .category-dropdown -->
            </div><!-- End .header-left -->
            <div class="header-center">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="megamenu-container active">        
                            <a href="{{ url('/forbest') }}"  class="sf-with">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('product') }}"  class="sf-with">Shop</a>
                        </li>
                        <li>
                           <a href="{{ url('/blogall') }}"  class="sf-with">Blog</a>
                        </li>
                        <li>
                            <a href="{{ url('/about') }}" class="sf-with">About</a>
                        </li>
                        <li>
                            <a href="{{ url('/forbest/faqs') }}" class="sf-with">FAQs</a>
                        </li>
                        <li>
                            <a href="#" class="sf-with-ul">Pages</a>
                            <ul>
                                <li>
                                    <a href="{{ url('/about') }}"  class="sf-with-ul">About</a>
                                </li>
                                <li>
                                    <a href="{{ url('/contact') }}"  class="sf-with-ul">Contact</a>
                                </li>
                                <li>
                                    <a href="{{ url('/forbest/faqs') }}" class="sf-with-ul" >FAQs</a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .col-lg-9 -->

            <div class="header-right">
                <div class="social-icons social-icons-color">
                    <span class="social-label">Social Media</span>
                    @php
                    $ver = $CompanyInfo->shuffle()->take(1);
                    @endphp
                    @foreach ($ver as $key =>$Company )
                    <a href="{{$Company->facebook_link}}" class="social-icon social-facebook" title="Facebook" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{$Company->twitter_link}}" class="social-icon social-twitter" title="X" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="{{$Company->youtube_link}}" class="social-icon social-instagram" title="Instagram" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endforeach
                </div><!-- End .social-icons -->
            </div>
            
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->