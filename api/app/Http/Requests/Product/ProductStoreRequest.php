<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;

class ProductStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'value' => ['required', 'numeric'],
            'type_id' => ['required', 'integer', 'exists:product_types,id'],
        ];
    }
}
