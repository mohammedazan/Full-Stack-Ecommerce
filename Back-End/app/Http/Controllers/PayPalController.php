<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function payment()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'Apple',
                'price' => 100,
                'desc'  => 'Macbook pro 14 inch',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
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
            // Now make the payment
            $payment_status = $provider->doExpressCheckoutPayment([
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
                'total' => 100,
            ], $response['TOKEN'], $response['PAYERID']);

            // Check if the payment was successful
            if ($payment_status['PAYMENTINFO_0_PAYMENTSTATUS'] === 'Completed') {
                return redirect()->route('checkout.confirmation')->with('success', 'Your payment was successful.');
            } else {
                return redirect()->route('cart')->with('error', 'Payment was not successful. Please try again.');
            }
        }

        return redirect()->route('cart')->with('error', 'Please try again later.');
    }
}
