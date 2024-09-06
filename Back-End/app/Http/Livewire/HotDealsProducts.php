<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class HotDealsProducts extends Component
{
    public $category;
    public $productList;

    public function mount()
    {
        // Load initial categories and products
        $this->category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $this->productList = Product::where('deleted', 0)->get();

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
        if ($id) {
            // Filter products by category ID
            $this->productList = Product::where('category_id', $id)
                ->where('deleted', 0)
                ->get();
        } else {
            // If no ID is passed, show all products
            $this->productList = Product::where('deleted', 0)->get();
        }

        // Dispatch an event to handle the UI update
        $this->dispatchBrowserEvent('contentChanged');

        // Handle case when no products are found
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

