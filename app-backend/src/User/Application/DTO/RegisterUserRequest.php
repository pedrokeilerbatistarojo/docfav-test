<?php

namespace App\User\Application\DTO;

final readonly class RegisterUserRequest
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}