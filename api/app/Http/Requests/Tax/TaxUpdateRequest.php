<?php

namespace App\Http\Requests\Tax;

use App\Http\Requests\BaseRequest;

class TaxUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'value' => ['sometimes', 'numeric'],
            'description' => ['sometimes', 'string'],
        ];
    }
}
