<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => ['sometimes', 'email', 'unique:users'],
            'name' => ['sometimes', 'string'],
            'password' => [
                'sometimes',
                'string',
                'confirmed',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'password must contain at least 8 characters,
            including at least 1 upperCase character, 1 lowerCase character, 1 symbol, 1 number'
        ];
    }
}