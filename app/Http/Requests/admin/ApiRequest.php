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
            'name' => 'required|min:1|max:150',
            'key' => 'required|min:1|max:250',
            'order_endpoint' => 'required|min:1|max:250',
            'order_method' => 'required|in:get,post',
            'order_id_key' => 'required|min:1|max:100',
            'status_endpoint' => 'required|min:1|max:250',
            'status_method' => 'required|in:get,post',
            'status_key' => 'required|min:1|max:100',
            'start_counter_key' => 'required|min:1|max:100',
            'remain_key' => 'required|min:1|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'key' => 'Key',
            'order_endpoint' => 'Order Endpoint',
            'order_method' => 'Order Method',
            'order_id_key' => 'Order ID Key',
            'status_endpoint' => 'Status Endpoint',
            'status_method' => 'Status Method',
            'status_key' => 'Status Key',
            'start_counter_key' => 'Start Counter Key',
            'remain_key' => 'Remain Key'
        ];
    }
}
