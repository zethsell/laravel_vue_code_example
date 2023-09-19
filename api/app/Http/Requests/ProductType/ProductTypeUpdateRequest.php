<?php

namespace App\Http\Requests\ProductType;

use App\Http\Requests\BaseRequest;

class ProductTypeUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'description' => ['sometimes', 'string'],
            'taxes' => ['sometimes', 'array'],
            'taxes.*.tax_id' => ['sometimes', 'integer', 'exists:taxes,id'],
        ];
    }
}
