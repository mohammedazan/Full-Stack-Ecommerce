<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\CompanyInfo;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Brand;
use App\Models\Commande;
use App\Models\Offer_product_list;
use App\Models\Product;
use App\Models\FeaturedLink;
use App\Models\Product_review;
use App\Models\ProductSubCategory;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Faq;
use App\Models\ProductColor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class GuestController extends Controller
{ 

    public function search(Request $request)
    {
        try {
            $query = $request->input('q');
            if ($query) {
                Log::info('Search query: ' . $query); // Debug message
    
                $products = Product::where('name', 'LIKE', '%' . $query . '%')
                                   ->where('deleted', 0)
                                   ->get();
    
                Log::info('Search results: ' . $products->toJson()); // Debug message
    
                if ($products->isEmpty()) {
                    return '<ul class="list-unstyled"><li>No products found</li></ul>';
                }
    
                $output = '<ul class="list-unstyled">';
                foreach ($products as $product) {
                    $output .= '<li><a href="javascript:void(0);" class="search-result-item" data-id="' . $product->id . '">' . $product->name . '</a></li>';
                }
                $output .= '</ul>';
    
                return $output;
            } else {
                return '<ul class="list-unstyled"><li>No query provided</li></ul>';
            }
        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function Home(Request $request){

        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productCategory = ProductCategory::where('deleted', 0)->where('status', 1)->get();
        $offer = Offer::where('deleted', 0)->get();
        $featuredImage=FeaturedLink::get();
        $Blogs=Blogs::all();
        $brandList=Brand::get();
        $CompanyInfo=CompanyInfo::get();

        $categoryId = $request->id;
        if ($categoryId) {
            $productList = Product::where('category_id', $categoryId)
                                  ->where('deleted', 0)
                                  ->get();
        } else {
            $productList = Product::where('deleted', 0)->get();
        }
        if ($productList->isEmpty()) {
            return redirect()->back();
        }


          // Calculate average rating and reviews count for each product
    foreach ($productList as $product) {
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

        return view('guest/home')->with(compact('productSubcategory','productList','category','productCategory','offer','featuredImage','brandList','Blogs','CompanyInfo'));
    }



    public function about(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $company = CompanyInfo::first();
        $CompanyInfo=CompanyInfo::get();
        return view('guest/pages.about')->with(compact('productSubcategory','category','company','CompanyInfo'));

    }

    // public function contact(){
    //     $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
    //     $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
    //     return view('guest/pages.contact')->with(compact('productSubcategory','category'));
    // }


  
    

 
    public function product(){
        $productList = Product::where('deleted', 0)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList=Brand::get();
        $CompanyInfo=CompanyInfo::get();
        return view('guest/pages.product')->with(compact('productList','category','brandList','productSubcategory','CompanyInfo'));
    }


    public function product_list(Request $request){
        $productList = Product::where('deleted', 0)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList=Brand::get();
        $CompanyInfo=CompanyInfo::get();

      
    // Calculate average rating and reviews count for each product
    foreach ($productList as $product) {
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

        return view('guest/pages.product_list')->with(compact('productList','category','brandList','productSubcategory','CompanyInfo'));
    }




    public function productcategory(Request $request) {
        $brandList = Brand::get();
        $CompanyInfo=CompanyInfo::get();
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
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
        return view('guest/pages.product')->with(compact('productList','productSubcategory', 'category', 'brandList','CompanyInfo'));
    }
    public function product_list_category(Request $request) {
        $brandList = Brand::get();
        $CompanyInfo=CompanyInfo::get();
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
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
        return view('guest/pages.product_list')->with(compact('productList','productSubcategory', 'category', 'brandList','CompanyInfo'));
    }

    public function productsubcategory(Request $request) {
        $brandList = Brand::get();
        $CompanyInfo=CompanyInfo::get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
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
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
        return view('guest/pages.product')->with(compact('productList', 'productSubcategory','category', 'brandList','CompanyInfo'));
    }
    

    public function productdetail(Request $request){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $color = ProductColor::get();

        $productdetail = Product::find($request->id);
        $CompanyInfo=CompanyInfo::get();
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
                }


        return view('guest/pages/productdetail')->with(compact('productSubcategory', 'category', 'productdetail','productList', 'avgRating','CompanyInfo','color'));
    }

    public function productoffer(Request $request){
        $offerId = $request->id;
        if (!$offerId) {
            return redirect()->back();
        }
        $offerProductLists = Offer_product_list::where('offer_id', $offerId)->get();
    
        if ($offerProductLists->isEmpty()) {
            return  redirect()->back();
        }
        $productList = $offerProductLists->map(function($offerProductList) {
            return $offerProductList->productInfo;
        })->filter(); 
    
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList = Brand::get();
        $CompanyInfo=CompanyInfo::get();
    
        return view('guest/pages.product')->with(compact('productList', 'category', 'brandList', 'productSubcategory','CompanyInfo'));
    }

    public function productbrand(Request $request){
        $brandId = $request->id;
        $CompanyInfo=CompanyInfo::get();
    
        if (!$brandId) {
            return redirect()->back();
        }
    
        $productList = Product::where('brand_id', $brandId)->where('deleted', 0)->get();
    
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
    
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList = Brand::get();
    
        return view('guest/pages.product')->with(compact('productList', 'category', 'brandList', 'productSubcategory','CompanyInfo'));
    }

    public function product_list_brand(Request $request){
        $brandId = $request->id;
        $CompanyInfo=CompanyInfo::get();
    
        if (!$brandId) {
            return redirect()->back();
        }
    
        $productList = Product::where('brand_id', $brandId)->where('deleted', 0)->get();
    
        if ($productList->isEmpty()) {
            return redirect()->back();
        }
    
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $brandList = Brand::get();
    
        return view('guest/pages.product_list')->with(compact('productList', 'category', 'brandList', 'productSubcategory','CompanyInfo'));
    }


    public function faqView(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productCategory = ProductCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $faqList=Faq::get();
        return view('guest/pages.faqs')->with(compact('category', 'productCategory', 'productSubcategory','faqList','CompanyInfo'));

    }





    
    
    


    // public function listuser(){
    //     $listuser = User::get();
    //     return view('Login/login', compact('listuser'));
    // }

    

}
