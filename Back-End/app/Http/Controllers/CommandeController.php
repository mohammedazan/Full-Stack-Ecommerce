<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{

    
    public function order_in_the_cart(){
        $commande = Commande::all();


        return view('adminPanel.Commande.order_in_the_cart')->with(compact('commande'));
    }

    
    // public function indexLCommandes(){
    //     $LigneCommande=LigneCommande::all();
    //     return view('Admin/LigneCommande/lignecommande')->with('LigneCommande',$LigneCommande);
    // }

    
    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'qte' => 'required|integer',
            'idproduct' => 'required|integer|exists:products,id',
        ]);
    
        // Get the ongoing order for the authenticated user
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
    
        if ($commande) {
            $existe = false;
    
            // Check if the product already exists in the order
            foreach ($commande->lignecommande as $lignec) {
                if ($lignec->product_id == $request->idproduct) {
                    $existe = true;
                    $lignec->qte += $request->qte;
                    $lignec->save(); // Save the updated quantity
                }
            }
    
            // If the product does not exist in the order, create a new line item
            if (!$existe) {
                $Lc = new LigneCommande();
                $Lc->qte = $request->qte;
                $Lc->product_id = $request->idproduct;
                $Lc->commande_id = $commande->id;
                $Lc->save();
            }
    
            return redirect('/user/cart')->with('success', 'Product added to order successfully.');
        } else {
            // If no ongoing order, create a new order
            $commande = new Commande();
            $commande->users_id = Auth::user()->id;
            $commande->etat = 'en cours'; // Assuming 'en cours' is a valid state for a new order
    
            if ($commande->save()) {
                // Create the line item for the new order
                $Lc = new LigneCommande();
                $Lc->qte = $request->qte;
                $Lc->product_id = $request->idproduct;
                $Lc->commande_id = $commande->id;
                $Lc->save();
                return redirect('/user/cart')->with('success', 'Order created and product added successfully.');
            } else {
                return redirect()->back()->with('error', "Unable to create order.");
            }
        }
    }


    public function LigneCommandedestroy($id){

        $lc = LigneCommande::find($id);

        if ($lc) {
            // Delete the record
            $lc->delete();
            return redirect()->back()->with('success', 'Ligne de commande supprimée');
        }
            return redirect()->back()->with('error', 'Ligne de commande introuvable');
    }


    public function cart(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        

        // $shippingCost = 0; // Default shipping cost



        return view('guest/pages.cart')->with(compact('productSubcategory','category','commande',));
    }

    // public function checkout(Request $request){
    //     $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
    //     $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
    //     $productdetail = Product::find($request->id);
    //     $productList = Product::where('deleted', 0)->get();
    //     return view('guest/pages/checkout')->with(compact('productSubcategory', 'category', 'productdetail','productList'));
    // }
    

    // public function checkoutsubmit(Request $request){
    //     $commande = Commande::first();
    //     return view('guest/pages.checkout')->with(compact('commande'));
    //     dd($request);
    //                                                                }


}
