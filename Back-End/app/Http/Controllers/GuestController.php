<?php

namespace App\Http\Controllers;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\FeaturedLink;
use App\Models\ProductSubCategory;
class GuestController extends Controller
{
   
    public function Home(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $offer = Offer::where('deleted', 0)->get();
        $featuredImage=FeaturedLink::get();
        return view('guest/home')->with(compact('productSubcategory','category','offer','featuredImage'));
    }


    public function about(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.about')->with(compact('productSubcategory','category'));

    }

    public function contact(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.contact')->with(compact('productSubcategory','category'));
    }

    public function checkout(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.checkout')->with(compact('productSubcategory','category'));
    }

    public function wishlist(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.wishlist')->with(compact('productSubcategory','category'));
    }

    public function cart(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.cart')->with(compact('productSubcategory','category'));
    }

    public function product(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.product')->with(compact('productSubcategory','category'));
    }

    public function productdetail(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.productdetail')->with(compact('productSubcategory','category'));
    }

}
