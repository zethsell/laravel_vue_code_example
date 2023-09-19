<?php


namespace App\DTOs\Auth;

use Illuminate\Support\Arr;

readonly class SignUpDTO
{
    public string $password;
    public string $name;
    public string $email;

    public function __construct(array $input)
    {
        $this->password = Arr::get($input, 'password');
        $this->name = Arr::get($input, 'name');
        $this->email = Arr::get($input, 'email');
    }
}
