<?php

namespace App\Http\Requests\Sell;

use App\Http\Requests\BaseRequest;

class SellUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'details' => ['required', 'array'],
            'details.*.product_id' => ['sometimes', 'integer', 'exists:products,id'],
            'details.*.value' => ['sometimes', 'numeric'],
            'details.*.quantity' => ['sometimes', 'numeric'],
            'details.*.tax' => ['sometimes', 'numeric'],
        ];
    }
}
