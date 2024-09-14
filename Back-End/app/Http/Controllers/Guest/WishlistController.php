<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Commande;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the wishlist items for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch wishlist items associated with the authenticated user
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        $CompanyInfo=CompanyInfo::get();
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $productCategory = ProductCategory::where('deleted', 0)->where('status', 1)->get();
        $CompanyInfo=CompanyInfo::get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  

        
        // Return the wishlist view with the wishlist items and other necessary data
        return view('guest.pages.wishlist', compact('wishlistItems','CompanyInfo','category', 'productCategory', 'productSubcategory','CompanyInfo','wishlistCount','CartCountEnCours'));
    }

    /**
     * Add a product to the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {   
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);
    
    

        // Check if the product is already in the user's wishlist
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();
    
        if ($exists) {
            return redirect()->back()->with('error', 'Product is already in your wishlist.');
        }
    
        // Create a new wishlist item
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist.');
    }
    

    /**
     * Remove a product from the wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
