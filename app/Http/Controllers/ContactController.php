<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\ProductSubCategory;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact_mail_send(Request $request)
    {
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();

        Mail::to('he34124@gmail.com')->send(new ContactMail($request));
        return redirect( 'guest.pages.contact');

        return back()->with('success', 'Email sent successfully!');
    }

    public function contact()
    {
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $CompanyInfo=CompanyInfo::get();

        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  
            
        return view('guest.pages.contact')->with(compact('productSubcategory', 'category','CompanyInfo','CartCountEnCours','wishlistCount'));
    }
}