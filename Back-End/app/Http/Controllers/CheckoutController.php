<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckoutController extends Controller
{
    public function index()
    {
        // Fetch the ongoing order for the authenticated user
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        
        return view('guest/pages.checkout', compact('commande', 'category'));
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

        // Determine the payment method chosen
        $paymentMethod = $request->input('payment_method');
        if ($paymentMethod === 'paypal') {
            // Calculate total price based on items in the cart
            $totalPrice = $this->calculateTotalPrice($commande); // Call to calculateTotalPrice method
            // Prepare payment data
            $data = [];
            $data['items'] = $this->getItemsForPaypal($commande); // Get items in the cart
            $data['invoice_id'] = $commande->id;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $totalPrice;
            // Initialize PayPal provider
            $provider = new ExpressCheckout;
            // Set express checkout with the prepared data
            $response = $provider->setExpressCheckout($data);
            // Redirect to PayPal payment page
            return redirect($response['paypal_link']);
        } elseif ($paymentMethod === 'visa') {
            // Logic to handle Visa card payment
            // For demonstration, redirecting to a Visa card mock payment success route
            return redirect()->route('visa.payment')->with('commandeId', $commande->id);
        }

        // Optionally, you can add more logic here, such as sending email notifications, processing payment, etc.
    
        // Redirect the user to a confirmation page or wherever you want
    }

    // Method to calculate total price based on items in the cart
    protected function calculateTotalPrice($commande)
    {
        $total = 0;

        foreach ($commande->lignecommande as $ligne) {
            $total += $ligne->product->price * $ligne->qte;
        }

        return $total;
    }

    // Prepare items for PayPal payment
    protected function getItemsForPaypal($commande)
    {
        $items = [];
        foreach ($commande->lignecommande as $ligne) {
            $items[] = [
                'name' => $ligne->product->name,
                'price' => $ligne->product->price,
                'description' => $ligne->product->description,
                'qte' => $ligne->qte
            ];
        }
        return $items;
    }


    

  
    


    public function cancel()
    {
        return redirect()->route('checkout')->with('error', 'Your payment is canceled.');
    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
    
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // Find the order by invoice ID
            $commandeId = $response['INVNUM'];
            $commande = Commande::find($commandeId);

               // Calculate total price again for safety
                
            if ($commande) {
                // Update the order status to 'payee'
                $commande->etat = 'payee';
                $commande->save();
            }

            $totalPrice = $this->calculateTotalPrice($commande);


            // return view('guest/pages.confirmation', compact('commande'));
    
            return view('guest/pages.confirmation', compact('commande',"totalPrice"));
        
        
        }
    
        return redirect()->route('checkout')->with('error', 'Please try again later.');
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

