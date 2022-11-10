<?php

namespace App\Http\Requests\admin;

use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateUserDetailsRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:150'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($this->user)],
            'contact' => ['required', 'max:150'],
            'timezone' => ['nullable', 'numeric', 'min:-100000', 'max:100000'],
            'status' => ['required', new Enum(UserStatusEnum::class)],
            'api_key' => ['nullable', 'min:55', 'max:55'],
            'password' => ['required_if:set_new_password,1', 'min:6', 'max:50']
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'E-mail',
            'contact' => 'Contact',
            'timezone' => 'Timezone',
            'status' => 'Status',
            'api_key' => 'API Key',
            'password' => 'Password'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required_if' => ':attribute field is required to edit user details.',
        ];
    }

}
