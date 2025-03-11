<?php

namespace App\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserPassword
{
    private string $hashedValue;

    public function __construct(string $password)
    {
        $this->ensureValidPassword($password);
        $this->hashedValue = password_hash($password, PASSWORD_DEFAULT);
    }

    private function ensureValidPassword(string $password): void
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException("Password must be at least 8 characters long");
        }

        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
            throw new InvalidArgumentException("Password must contain at least one uppercase letter, one lowercase letter, and one number");
        }
    }

    public function value(): string
    {
        return $this->hashedValue;
    }

    public function verify(string $password): bool
    {
        return password_verify($password, $this->hashedValue);
    }
}