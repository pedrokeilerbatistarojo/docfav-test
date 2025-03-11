<?php

namespace App\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserId
{
    public function __construct(
        private readonly string $value
    ){
        if (!self::isValidUuid($value)) {
            throw new InvalidArgumentException("Invalid UUID format");
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    private static function isValidUuid(string $uuid): bool
    {
        return preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $uuid);
    }
}