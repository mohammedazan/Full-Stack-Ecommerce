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
        $data = [
            'items' => [
                [
                    'name' => 'Apple',
                    'price' => 100,
                    'desc'  => 'Macbook pro 14 inch',
                    'qty' => 1
                ]
            ],
            'invoice_id' => 1,
            'invoice_description' => "Order #1 Invoice",
            'return_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'total' => 100,
        ];
    
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
    
        // Check if the PayPal link is generated successfully
        if (isset($response['paypal_link'])) {
            // Redirect to PayPal payment page
            return redirect($response['paypal_link']);
        } else {
            // Redirect back to where the user came from or show an error message
            return redirect()->route('cart')->with('error', 'Failed to initiate PayPal payment. Please try again.');
        }
    }

    public function cancel()
    {
        return redirect()->route('cart')->with('error', 'Your payment is canceled.');
    }
    
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
    
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            // Payment was successful, handle further actions like updating order status
            // and redirect to a confirmation page or show a success message
            return redirect()->route('checkout.confirmation')->with('success', 'Your payment was successful.');
        }
    
        // Payment failed or not successful, handle accordingly
        return redirect()->route('cart')->with('error', 'Your payment was not successful. Please try again.');
    }
    
        
 }