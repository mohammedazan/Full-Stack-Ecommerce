<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductList extends Component
{
    public $categories;
    public $selectedCategory;
    public $products;

    public function mount()
    {
        $this->categories = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $this->selectedCategory = null;
        $this->products = Product::where('deleted', 0)->get();
    }

    public function updatedSelectedCategory($categoryId)
    {
        if ($categoryId) {
            $this->products = Product::where('category_id', $categoryId)
                ->where('deleted', 0)
                ->get();
        } else {
            $this->products = Product::where('deleted', 0)->get();
        }
    }

    public function render()
    {
        return view('livewire.product-list', [
            'categories' => $this->categories,
            'products' => $this->products,
        ]);
    }
}
