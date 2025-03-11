<?php

namespace App\User\Application\DTO;

final readonly class UserResponseDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $createdAt
    ) {}
}