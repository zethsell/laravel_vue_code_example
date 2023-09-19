<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class ProductUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'description' => ['sometimes', 'string'],
            'value' => ['sometimes', 'numeric'],
            'type_id' => ['sometimes', 'integer', 'exists:product_types,id'],
        ];
    }
}
