<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
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
use App\Models\LigneCommande;
use App\Models\ProductColor;
use App\Models\Wishlist;
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



    public function Home(Request $request)
    {
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $offer = Offer::where('deleted', 0)->get();
        $featuredImage = FeaturedLink::get();
        $Blogs = Blogs::all();
        $brandList = Brand::get();
        $CompanyInfo = CompanyInfo::get();
    
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
    
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
    
        $commandesEnCours = Commande::where('users_id', Auth::id())
            ->where('etat', 'en cours')
            ->get();
        $CartCountEnCours = 0;
        foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
        }
    
        return view('guest/home')->with(compact('productSubcategory', 'productList', 'category', 'offer', 'featuredImage', 'brandList', 'Blogs', 'CompanyInfo', 'wishlistCount', 'CartCountEnCours'));
    }
    


    public function about(){
        
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $company = CompanyInfo::first();
        $CompanyInfo=CompanyInfo::get();
        $aboutUs = AboutUs::first();
        $AboutUsInfo=AboutUs::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $brandList=Brand::get();
   
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  

        return view('guest/pages.about')->with(compact('productSubcategory','category','company','CompanyInfo','wishlistCount','CartCountEnCours','brandList','aboutUs','AboutUsInfo'));

    }

    public function product(){
        $ID = null ;
        $filterSource = null ;
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())->where('etat', 'en cours')->get();
        $CartCountEnCours = 0;
        foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
        }  

        return view('guest/pages.product')->with(compact('category','productSubcategory','CompanyInfo','wishlistCount','CartCountEnCours','ID','filterSource'));
    }

    public function productcategory(Request $request) {
        $ID =  $request->id ;
        $filterSource = 'category';
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())->where('etat', 'en cours')->get();
        $CartCountEnCours = 0;
        foreach ($commandesEnCours as $commande) {
         $CartCountEnCours += $commande->lignecommande->count();
        }  
        return view('guest/pages.product')->with(compact('category','productSubcategory','CompanyInfo','wishlistCount','CartCountEnCours','ID','filterSource'));
    }

    public function productsubcategory(Request $request) {
        $ID =  $request->id ; 
        $filterSource = 'subcategory';
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $brandList = Brand::get();
        $CompanyInfo=CompanyInfo::get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }
 
        return view('guest/pages.product')->with(compact( 'productSubcategory','category', 'brandList','CompanyInfo','wishlistCount','CartCountEnCours','ID','filterSource'));
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


        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }
        return view('guest/pages/productdetail')->with(compact('productSubcategory', 'category', 'productdetail','productList', 'avgRating','CompanyInfo','color','wishlistCount','CartCountEnCours'));
    }


    public function productoffer(Request $request){
        $ID = $request->id;
        $filterSource = 'offer';
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  

        return view('guest/pages.product')->with(compact('category','productSubcategory','CompanyInfo','wishlistCount','CartCountEnCours','ID','filterSource'));
    }
    
    public function productbrand(Request $request){
        $ID = $request->id;
        $filterSource = 'brand';
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  

        return view('guest/pages.product')->with(compact('category','productSubcategory','CompanyInfo','wishlistCount','CartCountEnCours','ID','filterSource'));
    }

    public function faqView(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productCategory = ProductCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $faqList=Faq::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  

        return view('guest/pages.faqs')->with(compact('category', 'productCategory', 'productSubcategory','faqList','CompanyInfo','wishlistCount','CartCountEnCours'));

    }





    
    
    


    // public function listuser(){
    //     $listuser = User::get();
    //     return view('Login/login', compact('listuser'));
    // }

    

}
