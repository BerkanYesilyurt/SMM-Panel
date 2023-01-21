<?php

namespace App\Http\Controllers;

use App\Enums\ActiveInactiveState;
use App\Enums\PaymentStatusEnum;
use App\Models\PaymentLog;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function addFundsPage()
    {
        return view('pages.addfunds', [
            'paymentMethods' => PaymentMethod::where('status', ActiveInactiveState::ACTIVE->value)->get()
        ]);
    }

    public function paymentMethodPage(PaymentMethod $paymentMethod)
    {
        if($paymentMethod->status == ActiveInactiveState::ACTIVE->value){
            return view('pages.payment-method', [
                'paymentMethod' => $paymentMethod,
                'paymentMethods' => PaymentMethod::all()
            ]);
        }
        abort(404);
    }

    public function pay(PaymentMethod $paymentMethod, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:'.$paymentMethod->min_amount.'|max:'.$paymentMethod->max_amount
        ]);

        $this->createPaymentLog($paymentMethod->id, $request->amount);

        //TODO: payment

        return back()->with('message', 'You have successfully added funds to your account.');
    }

    public function createPaymentLog($payment_method_id, $amount)
    {
        $user = auth()->user();
        $details = [];
        $details['user_id'] = $user->id;
        $details['email'] = $user->email;
        $details['balance'] = $user->balance;
        $details['last_login'] = $user->last_login;
        $details['last_login_ip'] = $user->last_login_ip;

        PaymentLog::create([
            'user_id' => $user->id,
            'payment_method_id' => $payment_method_id,
            'currency' => ConfigController::configs()['currency'],
            'amount' => $amount,
            'details' => $details,
            'status' => PaymentStatusEnum::PENDING->value
        ]);
    }
}
