<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //



    
    public function UserProfile(){        
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'payee')->first();
        return view('guest/User/user_profile', compact('commande')); 

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
