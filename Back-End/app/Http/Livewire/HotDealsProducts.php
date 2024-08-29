<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class HotDealsProducts extends Component
{
    public function render()
    {
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productList = Product::where('deleted', 0)->get();
        return view('livewire.hot-deals-products')->with(compact('category','productList'));
    }
}
