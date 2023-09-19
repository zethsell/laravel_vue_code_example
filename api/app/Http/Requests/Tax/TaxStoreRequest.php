<?php

namespace App\Http\Requests\Tax;

use App\Http\Requests\BaseRequest;

class TaxStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];
    }
}
