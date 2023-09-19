<?php

namespace App\Http\Requests\Sell;

use App\Http\Requests\BaseRequest;

class SellStoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'details' => ['required', 'array'],
            'details.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'details.*.value' => ['required', 'numeric'],
            'details.*.quantity' => ['required', 'numeric'],
            'details.*.tax' => ['required', 'numeric'],
        ];
    }
}
