<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
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
        ->where('etat', 'payee')
        ->with('lignecommande')
        ->get(); 
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        
        $CartCount = 0;
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  

         return view('guest/User/user_profile', compact('commande','CompanyInfo','commandeall','productSubcategory','category','CartCountEnCours','wishlistCount')); 
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
