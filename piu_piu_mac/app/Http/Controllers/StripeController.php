<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Auth;
use Stripe\Exception\CardException;

use Laravel\Cashier\Exceptions\IncompletePayment;

class StripeController extends Controller
{
    public function index()
    {
        return view('stripe.index');
    }

    public function store(Request $request)
    {

        // $user = Auth::user();
        // $stripe = new StripeClient(env('STRIPE_SECRET'));

        // try {
        //     $charge = $user->charge(400, $request->payment_method);
        // }catch(IncompletePayment $e) {
        //     return redirect()->route('cashier.payment', [$e->payment->id, 'redirect' => route('gateway')]);
        // }

        // dd($charge);

        require_once(base_path() . '/vendor/stripe/stripe-php/init.php');
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));


            $charge = $stripe->paymentIntents->create([
                'amount' => 200,
                'currency' => 'ron',
                'payment_method' => $request->payment_method,
                'description' => 'Plata Test Wowddm',
                'confirm' => true,
            ]);

            if($charge->status == 'requires_action') {
                //dd($charge->next_action->use_stripe_sdk->stripe_js);
                $charge->next_action->use_stripe_sdk->return_url = "https://wowddm.ro/checkout";
                dd($charge);
                return redirect()->to($charge->next_action->use_stripe_sdk->stripe_js);
            }

            dd($charge);

            //$charge->confirm(['payment_method' => $request->payment_method, 'return_url' => route('checkout')]);
            return back()->withSuccess('Payment done.');
        } catch (CardException $th) {
            throw new Exception("There was a problem processing your payment", 1);
        }
    }
}
