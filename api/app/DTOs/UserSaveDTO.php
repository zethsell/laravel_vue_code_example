<?php


namespace App\DTOs;

use Illuminate\Support\Arr;

readonly class UserSaveDTO
{
    public null|string $password;
    public string $email;
    public string $name;

    public function __construct(array $input)
    {
        $this->password = Arr::get($input, 'password', null);
        $this->name = Arr::get($input, 'name');
        $this->email = strtolower(Arr::get($input, 'email', ''));
    }
}
