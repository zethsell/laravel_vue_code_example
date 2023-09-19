<?php


namespace App\DTOs;

use Illuminate\Support\Arr;

readonly class TaxSaveDTO
{
    public string $value;
    public string $description;

    public function __construct(array $input)
    {
        $this->description = Arr::get($input, 'description', null);
        $this->value = Arr::get($input, 'value');
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'description' => $this->description,
        ];
    }
}
