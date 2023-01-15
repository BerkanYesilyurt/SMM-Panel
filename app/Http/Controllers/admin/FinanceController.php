<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentLog;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function paymentMethodsPage()
    {
        return view('pages.admin.payment-methods', [
            'paymentMethods' => PaymentMethod::all()
        ]);
    }
}
