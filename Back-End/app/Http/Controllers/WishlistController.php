<?php

namespace App\Http\Controllers;

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
        
        // Fetch additional data if needed, like product categories or subcategories
        $productSubcategories = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $categories = ProductCategory::where('status', 1)->where('deleted', 0)->get();

        // Return the wishlist view with the wishlist items and other necessary data
        return view('guest.pages.wishlist', compact('wishlistItems', 'productSubcategories', 'categories'));
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
    public function remove($id)
    {
        // Find the wishlist item and delete it
        $wishlistItem = Wishlist::findOrFail($id);
        $wishlistItem->delete();

        // Redirect back to the wishlist page with a success message
        return redirect()->back()->with('success', 'Product removed from wishlist.');

        
    }
}
