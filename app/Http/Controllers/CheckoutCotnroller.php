<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckoutCotnroller extends Controller
{

    public function afterPayment(Request $request)
    {
        \Log::notice($request);
        dd($request);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
//    public function createCheckout()
//    {
//        $data = [];
//        $data['items'] = [
//            [
//                'name' => 'Product 1',
//                'price' => 9.99,
//                'qty' => 1
//            ]
//        ];
//
//        $data['invoice_id'] = 1;
//        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
//        $data['return_url'] = url('/payment/success');
//        $data['cancel_url'] = url('/cart');
//
//        $total = 0;
//        foreach($data['items'] as $item) {
//            $total += $item['price']*$item['qty'];
//        }
//
//        $data['total'] = $total;
//        $provider = new ExpressCheckout;
//        $response = $provider->setExpressCheckout($data);
//dd($data, $response);
//        // This will redirect user to PayPal
//        return redirect($response['paypal_link']);
//    }
}
