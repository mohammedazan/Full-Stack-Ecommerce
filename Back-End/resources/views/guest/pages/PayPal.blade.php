<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Wishlist<span>Shop</span></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            @if($wishlistItems->isEmpty())
                <div class="alert alert-info text-center">
                    Your wishlist is empty. <a href="{{ route('product') }}" class="btn btn-primary">Start Shopping</a>
                </div>
            @else
                <table class="table table-wishlist">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th>Actions</th>
                            <th></th>
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
                                        </h3>
                                    </div>
                                </td>
                                <td class="price-col">
                                    @if ($wishlistItem->product->discount_type == 1)
                                        <span class="new-price">${{ number_format($wishlistItem->product->current_sale_price * (1 - $wishlistItem->product->discount / 100), 2) }}</span>
                                        <span class="old-price">${{ number_format($wishlistItem->product->current_sale_price, 2) }}</span>
                                    @else
                                        <span class="new-price">${{ number_format($wishlistItem->product->current_sale_price, 2) }}</span>
                                    @endif
                                </td>
                                <td class="stock-col">
                                    @if($wishlistItem->product->available_quantity > 0)
                                        <span class="in-stock">In Stock</span>
                                    @else
                                        <span class="out-of-stock">Out of Stock</span>
                                    @endif
                                </td>
                                <td class="action-col">
                                    <a href="{{ route('productdetail', ['id' => $wishlistItem->product->id]) }}" class="btn btn-outline-primary-2">
                                        <i class="icon-eye"></i> View Details
                                    </a>
                                    <form action="{{ route('wishlist.remove', ['id' => $wishlistItem->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-remove">
                                            <i class="icon-close"></i> Remove
                                        </button>
                                    </form>
                                </td>
                                <td class="remove-col">
                                    <form action="{{ route('wishlist.remove', ['id' => $wishlistItem->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove"><i class="icon-close"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="wishlist-share">
                    <div class="social-icons social-icons-sm mb-2">
                        <label class="social-label">Share on:</label>
                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
