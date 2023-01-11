<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function addFundsPage()
    {
        return view('pages.addfunds', [
            'paymentMethods' => PaymentMethod::all()
        ]);
    }

    public function paymentMethodPage(PaymentMethod $paymentMethod)
    {
        return view('pages.payment-method', [
            'paymentMethod' => $paymentMethod,
            'paymentMethods' => PaymentMethod::all()
        ]);
    }

    public function pay(PaymentMethod $paymentMethod, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:'.$paymentMethod->min_amount.'|max:'.$paymentMethod->max_amount
        ]);

        $this->createPaymentLog($paymentMethod->id, $request->amount);

        //TODO: payment
    }

    public function createPaymentLog($payment_id, $amount)
    {
        //TODO: createPaymentLog
    }
}
