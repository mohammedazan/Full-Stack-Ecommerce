<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\LigneCommande;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{

    
    public function order_in_the_cart(){

        
        $commande = Commande::with('lignecommande')
        ->where('etat', 'payee')
        ->get(); 
        $CompanyInfo=CompanyInfo::get();
        return view('adminPanel.Commande.order_in_the_cart')->with(compact('commande','CompanyInfo'));
    }

    public function en_cours(){
        $commande = Commande::with('lignecommande')
        ->where('etat', 'en cours')
        ->get(); 
        $CompanyInfo=CompanyInfo::get();
        return view('adminPanel.Commande.en_cours')->with(compact('commande','CompanyInfo'));
    }





    public function showDetails($id)
    {

        $commande = Commande::with('lignecommande','country','city')
                            ->where('id', $id)
                            ->where('etat', 'payee') // Assuming 'payee' indicates a paid order status
                            ->first();
        if (!$commande) {
            return redirect()->back()->with('success', 'There is no information in this order');

        }



        // Assign variables for country and city
        $city = $commande->city;
    
        return view('adminPanel.Commande.commandeDetails', compact('commande','city'));
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


    public function destroy($id)
    {
        $commande = Commande::findOrFail($id); // Récupère la commande ou renvoie une erreur 404 si non trouvée

        $commande->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
    


    
    public function LigneCommandedestroy($id)
    {
        // Find the commande associated with the current user that is 'en cours'
        $commande = Commande::where('users_id', Auth::user()->id)
                            ->where('etat', 'en cours')
                            ->first();
            $lc = LigneCommande::find($id);
    
        if ($lc) {
            $lc->delete();
    
            if ($commande && $commande->lignecommande->isEmpty()) {
                // If no more lignecommandes, delete the commande
                $commande->delete();
            }
    
            return redirect()->back()->with('success', 'Order line deleted');
        }
        return redirect()->back()->with('error', 'Order not found .');
    }
    


    public function updateCart(Request $request) {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        if ($commande) {
            foreach ($request->quantities as $ligneCommandeId => $quantity) {
                $ligneCommande = LigneCommande::find($ligneCommandeId);
                if ($ligneCommande && $ligneCommande->commande_id == $commande->id) {
                    $ligneCommande->qte = $quantity;
                    $ligneCommande->save();
                }
            }
            return redirect('/user/cart')->with('success', 'Cart updated successfully.');
        } else {
            return redirect()->back()->with('error', 'No active order found.');
        }
    }

    

    public function cart(){
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();  
        // $shippingCost = 0; // Default shipping cost
        // $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $CompanyInfo=CompanyInfo::get();

        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();


     
        
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }

            
        return view('guest/pages.cart')->with(compact('productSubcategory','category','commande','CompanyInfo','wishlistCount','CartCountEnCours' ));
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
