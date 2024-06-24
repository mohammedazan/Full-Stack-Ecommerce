<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout ;
class PayPalController extends Controller
{
    
 
    public function payment()
    {
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        if (!$commande) {
            return redirect()->route('cart')->with('error', 'No active order found.');
        }
        
        // Calculate total price based on items in the cart
        $totalPrice = $this->calculateTotalPrice($commande);

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
    }

    // Calculate total price of items in the cart
    protected function calculateTotalPrice($commande)
    {
        $totalPrice = 0;
        foreach ($commande->lignecommande as $ligne) {
            // Assuming each product has a 'price' attribute
            $totalPrice += $ligne->product->price * $ligne->qte;
        }
        // Add shipping cost or any additional charges if applicable
        // $totalPrice += $shippingCost;
        return $totalPrice;
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
            
            if ($commande) {
                // Update the order status to 'payee'
                $commande->etat = 'payee';
                $commande->save();
            }

            return redirect()->route('checkout.confirmation')->with('success', 'Your payment was successful.');
        }

        return redirect()->route('checkout')->with('error', 'Please try again later.');
    }
}
