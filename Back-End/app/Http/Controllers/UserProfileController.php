<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //



    
    public function UserProfile(){        
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'payee')->first();
        $CompanyInfo=CompanyInfo::get();
        $commandeall = Commande::where('users_id', Auth::user()->id)
        ->with('lignecommande')
        ->get(); 
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        
        $CartCount = 0;
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandes = Commande::where('users_id', Auth::id())->get();

    // Loop through each Commande and count the total number of items
    foreach ($commandes as $commande) {
        $CartCount += $commande->lignecommande->count();
    }

         return view('guest/User/user_profile', compact('commande','CompanyInfo','commandeall','productSubcategory','category','CartCount','wishlistCount')); 
    }



    public function updateProfile(Request $request){

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password only if it's not empty
        // Check if a new password is provided
    if ($request->filled('password')) {
        // Hash the new password
        $user->password = Hash::make($request->input('password'));
    }

    // Save the updated user details
          $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
        
    }

}
