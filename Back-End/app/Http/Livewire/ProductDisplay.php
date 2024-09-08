<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Commande;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDisplay extends Component
{
    public $layout = 'grid'; // default layout is grid
    public $productList;
    public $category;
    public $productSubcategory;
    public $wishlistCount;
    public $CartCountEnCours = 0;
    public $brandList;

    public function mount()
    {
        // Initialize your properties
        $this->productList = Product::where('deleted', 0)->get();
        $this->category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $this->productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $this->wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $this->brandList = Brand::get();

        // Calculate average ratings for products
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

    public function switchLayout($layout)
    {
        $this->layout = $layout;
    }

    public function  productcategory($categoryId){
        if ($categoryId) {
            $this->productList= Product::where('category_id', $categoryId)
                                  ->where('deleted', 0)
                                  ->get();
        } else {
            $this->productList = Product::where('deleted', 0)->get();
        }


        if ($this->productList->isEmpty()) {
            return redirect()->back();
        }
    }
    public function productbrand($brandId) {
        if (!$brandId) {
            return redirect()->back();
        }
    
        $this->productList= Product::where('brand_id', $brandId)->where('deleted', 0)->get();
    
        if ($this->productList->isEmpty()) {
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.product-display', [
            'productList' => $this->productList,
            'category' => $this->category,
            'productSubcategory' => $this->productSubcategory,
            'wishlistCount' => $this->wishlistCount,
            'CartCountEnCours' => $this->CartCountEnCours,
            'layout' => $this->layout,
            'brandList'=>$this->brandList
        ]);
    }
    
}

