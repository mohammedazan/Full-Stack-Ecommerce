<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Fetch the ongoing order for the authenticated user
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        $category = ProductCategory ::where('status', 1)->where('deleted', 0)->get();
        
        return view('guest/pages.checkout', compact('commande','category'));
    }

    public function placeOrder(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'commande' => 'required|exists:commandes,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
            'street_address' => 'required|string',
            'town_city' => 'required|string',
            'state_county' => 'required|string',
            'postcode' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            // You can add more validation rules as needed
        ]);
    
        // Find the command
        $commandeId = $request->input('commande');
        $commande = Commande::find($commandeId);
    
        // If the command doesn't exist, redirect back with an error message
        if (!$commande) {

            return redirect()->back()->with('error', 'Invalid command');
            
        }


        // Update the command with billing details
        $commande->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'company_name' => $request->input('company_name'),
            'country' => $request->input('country'),
            'street_address' => $request->input('street_address'),
            'town_city' => $request->input('town_city'),
            'state_county' => $request->input('state_county'),
            'postcode' => $request->input('postcode'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
        ]);

        // Mark the command as paid
        $commande->etat = 'payee';
        $commande->save();

        return redirect()->route('user.checkout.confirmation')->with('success', 'Order placed successfully!');
    
        // Optionally, you can add more logic here, such as sending email notifications, processing payment, etc.
    
        // Redirect the user to a confirmation page or wherever you want

    }

    public function confirmation()
{
    // You can fetch the latest order here or pass it from the session if you are storing it there
    // For example:
    $commande = Commande::latest()->first();

    // Pass the command data to the view
    return view('guest/pages.confirmation', compact('commande'));
}
    
    
}
