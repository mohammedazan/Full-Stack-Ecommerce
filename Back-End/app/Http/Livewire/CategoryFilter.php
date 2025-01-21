<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\CompanyInfo;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategoryFilter extends Component
{
    
    public $productList;
    public $category;
    public $productSubcategory;
    public $wishlistCount;
    public $CartCountEnCours = 0;
    public $brandList;
    public $productdetail ;
    public $productImage ;
    public $CompanyInfo ;

    public function mount()
    {
        // Initialize your properties
        $this->productList = Product::where('deleted', 0)->get();
        $this->category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $this->productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $this->wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $this->brandList = Brand::get();
        $this->productdetail = Product::get();
        $this->productImage = ProductImage::get();
        $this->CompanyInfo = CompanyInfo::get() ;

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
    public function render()
    {
        return view('guest.pages.product', [
            'productList' => $this->productList,
            'category' => $this->category,
            'productSubcategory' => $this->productSubcategory,
            'productdetail' =>$this->productdetail ,
            'productImage' => $this->productImage,
            'CompanyInfo' => $this->CompanyInfo
        ]);
    }
}
