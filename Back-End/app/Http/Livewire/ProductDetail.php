<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductDetail extends Component
{
    public $color , $productdetail , $productList , $productdetail ;

    public function mount(){
        /***         $color = ProductColor::get();
        $productdetail = Product::find($request->id);
        $productList = Product::where('deleted', 0)->get();
        $productdetail = Product::find($request->id);
                // Initialize average rating
                $avgRating = 0;

                // Calculate average rating if there are reviews
                if ($productdetail && $productdetail->reviews->isNotEmpty()) {
                    $totalRating = 0;
                    foreach ($productdetail->reviews as $review) {
                        $totalRating += $review->rate;
                    }
                    $avgRating = $totalRating / $productdetail->reviews->count();
                }*/

    }
    public function render()
    {
        return view('livewire.product-detail');
    }
}
