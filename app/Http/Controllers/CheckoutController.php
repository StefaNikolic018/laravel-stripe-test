<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // Stripe secret
        \Stripe\Stripe::setApiKey('sk_test_51JlCw9GVC5CV6peYkLETbPaoHRsmiQwqb49NMqCvYtDgw1Hccl7Cj3C94hA7cVVoFELZKS1zlQrbWGcQBINVORob009x7AsMVc');

        $amount = 100;
        $amount *= 100;
        $amount = (int) $amount;

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $amount,
            'currency' => 'EUR',
            'description' => 'Payment from stefanikolic',
            'payment_method_types' => ['card'],
        ]);

        $intent = $payment_intent->client_secret;

        return view('checkout.credit-card',compact('intent'));
    }

    public function AfterPayment()
    {
        echo 'Payment has been Received';
    }
}
