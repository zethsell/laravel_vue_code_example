<?php


namespace App\DTOs\Auth;

use Illuminate\Support\Arr;

readonly class SignInDTO
{
    public string $password;
    public string $email;

    public function __construct(array $input)
    {
        $this->password = Arr::get($input, 'password');
        $this->email = strtolower(Arr::get($input, 'email', ''));
    }
}
