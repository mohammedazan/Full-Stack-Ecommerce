<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class HotDealsProducts extends Component
{
    public $category;
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

    public function render()
    {
        return view('livewire.hot-deals-products', [
            'category' => $this->category,
            'productList' => $this->productList,
        ]);
    }
}




