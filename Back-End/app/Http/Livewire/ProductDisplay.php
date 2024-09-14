<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\Offer_product_list;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\ProductImage;

class ProductDisplay extends Component
{
    public $layout = 'grid'; // Default layout is grid
    public $productList;
    public $category;
    public $productSubcategory;
    public $wishlistCount;
    public $CartCountEnCours = 0;
    public $brandList;
    public $productdetail;
    public $productImage;
    public $CompanyInfo;
    public $product_id;

    // Initialize properties and filter products based on $id and $filterSource
    public function mount($id = null, $filterSource = null) {
        // Load shared data
        $this->loadSharedData();

        // Handle filtering based on source
        switch ($filterSource) {
            case 'category':
                $this->filterByCategory($id);
                break;
            case 'subcategory':
                $this->filterByCategory($id);
                break;
            case 'brand':
                $this->filterByBrand($id);
                break;
            case 'offer':
                $this->filterByOffer($id);
                break;
            default:
                // Show all products if no filter source is provided
                $this->productList = Product::where('deleted', 0)->get();
        }

        // If no products are found, redirect back
        if ($this->productList->isEmpty()) {
            return redirect()->back();
        }

        // Calculate additional data such as ratings and cart count
        $this->calculateAdditionalData();
    }

    // Load shared data used across all filters
    private function loadSharedData() {
        $this->category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $this->productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $this->wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $this->brandList = Brand::get();
        $this->productdetail = Product::get();
        $this->productImage = ProductImage::get();
        $this->CompanyInfo = CompanyInfo::get();
    }

    // Filter products by category
    public function filterByCategory($categoryId = null) {
        $this->productList = Product::where('category_id', $categoryId)
                                    ->where('deleted', 0)
                                    ->get();
    }
    public function filterBySubCategory($subcategoryId = null) {
        if ($subcategoryId) {
            $productList = Product::where('subcategory_id', $subcategoryId)
                                  ->where('deleted', 0)
                                  ->get();
        } else {
            $productList = Product::where('deleted', 0)->get();
        }
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
    }

    // Filter products by brand
    public function filterByBrand($brandId) {
        $this->productList = Product::where('brand_id', $brandId)
                                    ->where('deleted', 0)
                                    ->get();
    }

    // Filter products by offer
    public function filterByOffer($offerId) {
        $offerProductLists = Offer_product_list::where('offer_id', $offerId)->get();
        $this->productList = $offerProductLists->map(function($offerProductList) {
            $product = $offerProductList->productInfo;
            if ($product) {
                // Apply discount based on offer type
                if ($offerProductList->offer_type == 1) { // Percentage discount
                    $product->discount = $offerProductList->offer_amount;
                    $product->discount_type = 1;
                } else if ($offerProductList->offer_type == 0) { // Fixed discount
                    $product->discount = $offerProductList->offer_amount;
                    $product->discount_type = 0;
                }
            }
            return $product;
        })->filter();
    }

    // Calculate additional data like ratings and cart count
    private function calculateAdditionalData() {
        foreach ($this->productList as $product) {
            $reviews = $product->reviews;
            if ($reviews->count() > 0) {
                $totalRating = $reviews->sum('rate');
                $product->avgRating = $totalRating / $reviews->count();
                $product->reviewsCount = $reviews->count();
            } else {
                $product->avgRating = 0;
                $product->reviewsCount = 0;
            }
        }
        // Calculate cart count for ongoing orders
        $commandesEnCours = Commande::where('users_id', Auth::id())
                                    ->where('etat', 'en cours')
                                    ->get();

        foreach ($commandesEnCours as $commande) {
            $this->CartCountEnCours += $commande->lignecommande->count();
        }
    }

    public function add($id_Wishlist)
    {
        // Assign the passed ID to the public property
        $this->product_id = $id_Wishlist;

        // Validate the product ID
        $this->validate([
            'product_id' => 'required|integer|exists:products,id', // Validate the product exists
        ]);

        // Check if the product is already in the user's wishlist
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->product_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Product is already in your wishlist.');
        }

        // Create a new wishlist item
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product_id,
        ]);

        // Optionally, update the wishlist count
        $this->wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        // Redirect or notify the user
        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    // Layout switcher
    public function switchLayout($layout) {
        $this->layout = $layout;
        session()->put('layout', $this->layout);
    }

    // Render the view with the data
    public function render() {
        return view('livewire.product-display', [
            'productList' => $this->productList,
            'category' => $this->category,
            'productSubcategory' => $this->productSubcategory,
            'wishlistCount' => $this->wishlistCount,
            'CartCountEnCours' => $this->CartCountEnCours,
            'layout' => $this->layout,
            'brandList' => $this->brandList,
            'productdetail' => $this->productdetail,
            'productImage' => $this->productImage,
        ]);
    }
}