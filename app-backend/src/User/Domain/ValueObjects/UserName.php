<?php

namespace App\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureValidLength($value);
        $this->ensureValidCharacters($value);

        $this->value = $value;
    }

    private function ensureValidLength(string $value): void
    {
        if (strlen($value) < 3 || strlen($value) > 50) {
            throw new InvalidArgumentException("User name must be between 3 and 50 characters");
        }
    }

    private function ensureValidCharacters(string $value): void
    {
        if (!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ ]+$/', $value)) {
            throw new InvalidArgumentException("User name contains invalid characters");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}