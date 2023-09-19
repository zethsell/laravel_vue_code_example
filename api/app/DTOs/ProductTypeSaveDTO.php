<?php


namespace App\DTOs;

use Illuminate\Support\Arr;

readonly class ProductTypeSaveDTO
{
    public string $description;
    public array $taxes;

    public function __construct(array $input)
    {
        $this->description = Arr::get($input, 'description', '');
        $this->taxes = Arr::get($input, 'taxes', []);
    }

    public function toArray(): array
    {
        return [
            'taxes' => $this->taxes,
            'description' => $this->description,
        ];
    }
}
