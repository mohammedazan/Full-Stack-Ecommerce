<div class="page-content">
    <div class="container">
        @if($wishlistItems->isEmpty())
        <div class="alert alert-info text-center">
            Your wishlist is empty. <a href="{{ route('product') }}" class="btn btn-primary">Start Shopping</a>
        </div>
        @else
        <table class="table table-wishlist table-mobile">
            <thead>
                <tr>
                    <th>Product fiver</th>
                    <th>Price</th>
                    <th>Stock Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($wishlistItems as $wishlistItem)
                <tr>
                    <td class="product-col">
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}">
                                    <img src="{{ asset($wishlistItem->product->image_path) }}" alt="{{ $wishlistItem->product->name }}">
                                </a>
                            </figure>

                            <h3 class="product-title">
                                <a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}">{{ $wishlistItem->product->name }}</a>
                            </h3><!-- End .product-title -->
                        </div><!-- End .product -->
                    </td>
                    <td class="price-col">
                        @if ($wishlistItem->product->previous_wholesale_price != $wishlistItem->product->current_sale_price)
                        <span class="new-price">{{ $wishlistItem->product->current_sale_price }}</span>
                            <sm class="old-price">Was {{ $wishlistItem->product->previous_wholesale_price  }}  DH</sm>
                        @else
                            <span class="old-price">{{ $wishlistItem->product->current_sale_price }}  DH</span>
                        @endif
                    </td>
                                                    
                    <td class="stock-col">
                        @if($wishlistItem->product->wholesale_minimum_qty > 0)
                        <span class="in-stock">In Stock</span>
                    @else
                        <span class="out-of-stock">Out of Stock</span>
                    @endif
                    </td>
                    <td class="action-col">
                        <div class="dropdown">
                        <button class="btn btn-block btn-outline-primary-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-list-alt"></i>Select Options
                        </button>

                        <div class="dropdown-menu">
                            <a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}"  class="dropdown-item" href="#">
                                Add to cart </a>

                                <form action="/user/order/store" method="post">
                                    @csrf
                                    <input type="hidden" name="idproduct" id="idproduct" class="form-control" value="{{$wishlistItem->product->id}}">
                                    <input type="hidden" name="qte" id="qte" class="form-control" value="1" required>
                                    <button class="dropdown-item" type="submit"><span>add to cart</span></button>
                                </form>  

                                <a  href="{{ route('product') }}" class="dropdown-item" href="#">
                                    Start Shopping </a>
                                
                          </div>
                        </div>
                    </td>
                    <td class="remove-col">
                            <button type="click" wire:click="remove('{{ $wishlistItem->id }}')"class="btn-remove"><i class="icon-close"></i></button>
                    </td>
                </tr>
                @endforeach

            
            </tbody>
        </table><!-- End .table table-wishlist -->
        <div class="wishlist-share">
            <div class="social-icons social-icons-sm mb-2">
                @foreach ($CompanyInfo as $key => $Company)
                <label class="social-label">Share on:</label>
                <a href="{{$Company->facebook_link}}" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="{{$Company->twitter_link}}" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                <a href="{{$Company->youtube_link}}" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                @endforeach
            </div><!-- End .soial-icons -->
        </div><!-- End .wishlist-share -->
        @endif

    </div><!-- End .container -->
</div><!-- End .page-content -->