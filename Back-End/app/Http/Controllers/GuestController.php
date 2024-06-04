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
}
