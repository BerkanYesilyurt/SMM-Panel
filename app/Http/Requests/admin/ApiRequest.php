<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:apis,id',
            'name' => 'required|min:1|max:150',
            'url' => 'required|url|min:1|max:250',
            'key' => 'required|min:1|max:250',
            'services_action' => 'required|min:1|max:100',
            'add_action' => 'required|min:1|max:100',
            'status_action' => 'required|min:1|max:100',
            'refill_action' => 'required|min:1|max:100',
            'refill_status_action' => 'required|min:1|max:100',
            'balance_action' => 'required|min:1|max:100',
            'service_key' => 'required|min:1|max:100',
            'link_key' => 'required|min:1|max:100',
            'quantity_key' => 'required|min:1|max:100',
            'order_key' => 'required|min:1|max:100',
            'orders_key' => 'required|min:1|max:100',
            'refill_key' => 'required|min:1|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'id' => 'API ID',
            'name' => 'API Name',
            'url' => 'API URL',
            'key' => 'API Key',
            'services_action' => 'Services Action',
            'add_action' => 'Add Action',
            'status_action' => 'Status Action',
            'refill_action' => 'Refill Action',
            'refill_status_action' => 'Refill Status Action',
            'balance_action' => 'Balance Action',
            'service_key' => 'Service Key',
            'link_key' => 'Link Key',
            'quantity_key' => 'Quantity Key',
            'order_key' => 'Order Key',
            'orders_key' => 'Orders Key',
            'refill_key' => 'Refill Key'
        ];
    }
}
