<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTicketRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'subject'            => ['required', 'max:100', Rule::in(['order', 'payment', 'request', 'childpanel', 'other'])],
            'orderid'            => ['required_if:subject,=,order', 'max:180'],
            'order_request'      => ['required_if:subject,=,order', 'max:100', Rule::in(['refill', 'cancel', 'speed-up', 'other'])],
            'payid'              => ['required_if:subject,=,payment', 'max:100'],
            'feature_request'    => ['required_if:subject,=,request', 'max:100', Rule::in(['feature', 'service', 'other'])],
            'message'            => ['required', 'max:5000']
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'subject'            => 'Subject',
            'orderid'            => 'Order ID',
            'order_request'      => 'Request',
            'payid'              => 'Payment ID',
            'feature_request'    => 'Request',
            'message'            => 'Message',
        ];
    }
}
