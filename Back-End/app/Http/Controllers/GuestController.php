<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\CompanyInfo;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Brand;
use App\Models\Offer_product_list;
use App\Models\Product;
use App\Models\FeaturedLink;
use App\Models\Product_review;
use App\Models\ProductSubCategory;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function Home(Request $request){

        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productCategory = ProductCategory::where('deleted', 0)->where('status', 1)->get();
        $offer = Offer::where('deleted', 0)->get();
        $featuredImage=FeaturedLink::get();
        $Blogs=Blogs::all();
        $brandList=Brand::get();


        $categoryId = $request->id;
        if ($categoryId) {
            $productList = Product::where('category_id', $categoryId)
                                  ->where('deleted', 0)
                                  ->get();
        } else {
            $productList = Product::where('deleted', 0)->get();
        }
        

             
    
        return view('guest/home')->with(compact('productSubcategory','productList','category','productCategory','offer','featuredImage','brandList','Blogs'));
    }


    public function about(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $company = CompanyInfo::first();
        return view('guest/pages.about')->with(compact('productSubcategory','category','company'));

    }

    // public function contact(){
    //     $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
    //     $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
    //     return view('guest/pages.contact')->with(compact('productSubcategory','category'));
    // }

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
        $productList = Product::where('deleted', 0)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList=Brand::get();
        return view('guest/pages.product')->with(compact('productList','category','brandList','productSubcategory'));
    }

    public function productcategory(Request $request) {
        $brandList = Brand::get();
        $categoryId = $request->id;
        if ($categoryId) {
            $productList = Product::where('category_id', $categoryId)
                                  ->where('deleted', 0)
                                  ->get();
        } else {
            $productList = Product::where('deleted', 0)->get();
        }
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();

    
        return view('guest/pages.product')->with(compact('productList','productSubcategory', 'category', 'brandList'));
    }

    public function productsubcategory(Request $request) {
        $brandList = Brand::get();
        // Get the subcategory_id from the request
        $subcategoryId = $request->id;
        // Query products based on the provided subcategory_id
        if ($subcategoryId) {
            $productList = Product::where('subcategory_id', $subcategoryId)
                                  ->where('deleted', 0)
                                  ->get();
        } else {
            $productList = Product::where('deleted', 0)->get();
        }
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        return view('guest/pages.product')->with(compact('productList', 'category', 'brandList'));
    }
    

    public function productdetail(Request $request){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productdetail = Product::find($request->id);
        $productList = Product::where('deleted', 0)->get();
        return view('guest/pages/productdetail')->with(compact('productSubcategory', 'category', 'productdetail','productList'));
    }

    public function productoffer(Request $request){
        $offerId = $request->id;
        if (!$offerId) {
            return response()->json(['error' => 'Offer ID not provided'], 400);
        }
    
        $offerProductLists = Offer_product_list::where('offer_id', $offerId)->get();
    
        if ($offerProductLists->isEmpty()) {
            return response()->json(['error' => 'No products found for this offer'], 404);
        }
    
        $productList = $offerProductLists->map(function($offerProductList) {
            return $offerProductList->productInfo;
        })->filter(); 
    
        if ($productList->isEmpty()) {
            return response()->json(['error' => 'No products associated with this offer'], 404);
        }
    
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList = Brand::get();
    
        return view('guest/pages.product')->with(compact('productList', 'category', 'brandList', 'productSubcategory'));
    }
    
    


    // public function listuser(){
    //     $listuser = User::get();
    //     return view('Login/login', compact('listuser'));
    // }

    

}
