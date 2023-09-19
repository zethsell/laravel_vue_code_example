<?php


namespace App\DTOs;

use Illuminate\Support\Arr;

readonly class ProductSaveDTO
{
    public string $description;
    public float $value;
    public int $typeId;

    public function __construct(array $input)
    {
        $this->description = Arr::get($input, 'description');
        $this->value = Arr::get($input, 'value');
        $this->typeId = Arr::get($input, 'type_id');
    }

    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'value' => $this->value,
            'typeId' => $this->typeId,
        ];
    }
}
