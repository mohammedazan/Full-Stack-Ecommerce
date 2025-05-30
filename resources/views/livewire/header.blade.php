<div class="header-dropdown-link">
    <a href="{{route('wishlist')}}" class="wishlist-link">
        <i class="icon-heart-o"></i>
        <span class="wishlist-count">
            {{$wishlistCount}}
        </span>
        <span class="wishlist-txt">
            Wishlist</span>
    </a> 
    <div class="dropdown cart-dropdown">
        <a href="{{ route('cart') }}" class="dropdown-toggle" >
            <i class="icon-shopping-cart"></i>
            <span class="cart-count">{{$cartCount}}</span>
            
            <span class="cart-txt">Cart</span>
        </a>

        {{-- <div class="dropdown-menu dropdown-menu-right">
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
        </div> --}}
        <!-- End .dropdown-menu -->
    </div><!-- End .cart-dropdown -->
</div>
