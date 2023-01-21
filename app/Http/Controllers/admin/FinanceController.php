<?php

namespace App\Http\Controllers\admin;

use App\Enums\ActiveInactiveState;
use App\Http\Controllers\Controller;
use App\Models\PaymentLog;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Str;

class FinanceController extends Controller
{
    public function paymentMethodsPage()
    {
        return view('pages.admin.payment-methods', [
            'paymentMethods' => PaymentMethod::all()
        ]);
    }

    public function createPaymentMethod(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|alpha|min:1|max:150',
            'icon' => 'required|min:1|max:150',
            'status' => new Enum(ActiveInactiveState::class),
            'config_key' => 'nullable|min:1|max:150',
            'config_value' => 'nullable|min:1|max:150',
            'min_amount' => 'required|numeric|min:0.01|max:99999',
            'max_amount' => 'required|numeric|min:0.01|max:99999|gte:min_amount',
            'is_manual' => new Enum(ActiveInactiveState::class),
            'content' => 'nullable|min:1|max:5000'
        ]);

        $fields['slug'] = Str::slug($request->name);
        PaymentMethod::create($fields);

        return back()->with('message', 'You have successfully created the payment method.');
    }

    public function updatePaymentMethod()
    {
        //TODO
    }

    public function deletePaymentMethod(Request $request)
    {
        $request->validate([
            'delete_id' => 'required|numeric|exists:payment_methods,id',
        ]);

        PaymentMethod::where('id', $request->delete_id)->delete();
        return back()->with('message', 'You have successfully deleted the payment method.');
    }
}
