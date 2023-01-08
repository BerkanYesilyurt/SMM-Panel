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
            'paymentMethod' => $paymentMethod
        ]);
    }
}
