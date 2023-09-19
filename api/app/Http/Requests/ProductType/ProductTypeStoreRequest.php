<?php

namespace App\Http\Requests\ProductType;

use App\Http\Requests\BaseRequest;

class ProductTypeStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'taxes' => ['required', 'array'],
            'taxes.*.tax_id' => ['required', 'integer', 'exists:taxes,id'],
        ];
    }
}
