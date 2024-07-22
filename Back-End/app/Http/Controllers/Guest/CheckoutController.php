<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Models\City;
use App\Models\Commande;
use App\Models\CompanyInfo;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Stripe\Charge;
use Stripe\Stripe;



class CheckoutController extends Controller
{
    public function index()
    {

        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        $commandesEnCours = Commande::where('users_id', Auth::id())
        ->where('etat', 'en cours')
        ->get();
            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {
            $CartCountEnCours += $commande->lignecommande->count();
            }  
        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $Product = Product::where('status', 1)->where('deleted', 0)->get();
        $CompanyInfo=CompanyInfo::get();

        $countries = Country::all();
        $cities = City::all();
        
        $commandes = Commande::latest()->first();


        return view('guest/pages.checkout', compact('productSubcategory','commande', 'category','CompanyInfo','countries','cities','CartCountEnCours','wishlistCount','Product'));
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
            'payment_method' => 'required|in:paypal,visa', // Ensure payment_method is either 'paypal' or 'visa'
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
    
        // Prepare payment data for PayPal or Visa based on selected method
        $totalPrice = $this->calculateTotalPrice($commande);
        $data = [];
        $data['items'] = $this->getItemsForPaypal($commande); // Get items in the cart
        $data['invoice_id'] = $commande->id;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['total'] = $totalPrice;
    
        if ($request->input('payment_method') === 'paypal') {
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $provider = new ExpressCheckout;
            $response = $provider->setExpressCheckout($data);
        } elseif ($request->input('payment_method') === 'visa') {

            try {
                // Stripe payment processing
                Stripe::setApiKey(env('STRIPE_SECRET'));
                Charge::create([
                    'amount' => $totalPrice , // Amount in cents
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Payment for order #' . $commande->id,
                ]);

                // Payment successful, update order status
                $commande->etat = 'payee';
                $commande->save();

                return redirect()->route('checkout.confirmation')->with('success', 'Your payment was successful.');
            } catch (\Exception $ex) {
                // Handle Stripe exceptions
                return redirect()->route('checkout')->with('error', 'Payment failed: ' . $ex->getMessage());
            }


        }
    
        // Check if the PayPal link is generated successfully
        if (isset($response['paypal_link'])) {
            // Redirect to PayPal payment page
            return redirect($response['paypal_link']);
        } else {
            // Redirect back to where the user came from or show an error message
            return redirect()->route('cart')->with('error', 'Failed to initiate PayPal payment. Please try again.');
        }
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

            return redirect()->route('forbest')->with('success', 'Your payment was successful.');
            
            // return redirect()->back()>with('success', 'Thank you for your order!');

        }

        return redirect()->route('forbest')->with('error', 'Please try again later.');
    }

    public function confirmation()
    {

        
        $productSubcategory = ProductSubCategory::where('deleted', 0)->where('status', 1)->get();

        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

        $commandesEnCours = Commande::where('users_id', Auth::id())

        ->where('etat', 'en cours')
        ->get();

            $CartCountEnCours = 0;
            foreach ($commandesEnCours as $commande) {

            $CartCountEnCours += $commande->lignecommande->count();

            }  

        $commande = Commande::where('users_id', Auth::user()->id)->where('etat', 'en cours')->first();
        $category = ProductCategory::where('status', 1)->where('deleted', 0)->get();
        $Product = Product::where('status', 1)->where('deleted', 0)->get();
        $CompanyInfo=CompanyInfo::get();
        $commande = Commande::latest()->first();
        return view('guest/pages.confirmation', compact('commande','productSubcategory','commande', 'category','CompanyInfo','CartCountEnCours','wishlistCount','Product'));

    }


    // public function generateInvoice($commandeId)
    // {
    //     $commande = Commande::findOrFail($commandeId);

    //     // Generate PDF from invoice.blade.php view
    //     $pdf = PDF::loadView('invoices.invoice', compact('commande'));

    //     // Download the PDF file with a specific name
    //     return $pdf->download('invoice.pdf');
    // }

}
