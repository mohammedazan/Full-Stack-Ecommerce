<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Wishlist;

class HotDealsProducts extends Component
{
    public $category ,$product_id;
    public $productList;
    public $activeCategory = null; // Default to null for "All"

    public function mount()
    {
        // Fetch categories with related products count and sort them consistently
        $this->category = ProductCategory::where('status', 1)
            ->where('deleted', 0)
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->orderBy('name', 'asc')
            ->take(4)
            ->get();

        // Load all products
        $this->productList = Product::where('deleted', 0)->get();

        // Calculate ratings for each product
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
    }
    
    
    public function CategoryFilter($id = null)
    {
        $this->activeCategory = $id; // Set the active category

        if ($id) {
            $this->productList = Product::where('category_id', $id)
                ->where('deleted', 0)
                ->get();
        } else {
            $this->productList = Product::where('deleted', 0)->get();
        }

        $this->dispatchBrowserEvent('contentChanged');

        if ($this->productList->isEmpty()) {
            session()->flash('message', 'No products found for this category.');
            return;
        }
    }

    public function add($id_Wishlist)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('success', 'تم إضافة المنتج إلى قائمة الأمنيات.');
        }

        $this->product_id = $id_Wishlist;

        $this->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $this->product_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'المنتج موجود بالفعل في قائمة الأمنيات.');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product_id,
        ]);

        // Emit an event to update the wishlist count in the header
        $this->emit('wishlistUpdated');
        
        // Refresh the product list
        $this->refreshProductList();

        // Optionally, you could flash a message indicating success
        session()->flash('success', 'تم إضافة المنتج إلى قائمة الأمنيات.');
    }
    public function refreshProductList()
    {
        if ($this->activeCategory) {
            $this->productList = Product::where('category_id', $this->activeCategory)
                ->where('deleted', 0)
                ->get();
        } else {
            $this->productList = Product::where('deleted', 0)->get();
        }

        $this->dispatchBrowserEvent('contentChanged');
    }


    public function render()
    {
        return view('livewire.hot-deals-products', [
            'category' => $this->category,
            'productList' => $this->productList,
        ]);
    }
}




