<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        try{
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken,
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->amount,
                'currency' => 'jpy',
            ));
        }catch(Exception $e){
            return $e->getMessage();
            return FALSE;
        }

        Reservation::create([
            "user_id" => Auth::id(),
            "shop_id" => $request->shop_id,
            "course_id" => $request->course_id,
            "date" => $request->date,
            "time" => $request->time,
            "number" => $request->number,
        ]);

        return redirect('/done');
    }
}
