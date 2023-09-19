<?php


namespace App\DTOs;

use Illuminate\Support\Arr;

readonly class SellSaveDTO
{
    public array $details;

    public function __construct(array $input)
    {
        $this->details = array_map(function ($detail) {
            return ["product_id" => Arr::get($detail, 'product_id'),
                "value" => Arr::get($detail, 'value'),
                "quantity" => Arr::get($detail, 'quantity'),
                "tax" => Arr::get($detail, 'tax')];
        }, $input['details']);
    }

    public function toArray(): array
    {
        return $this->details;
    }
}
