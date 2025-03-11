<?php

namespace App\User\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class UserCreatedAt
{
    private string $value;

    public function __construct()
    {
        $this->value = (new DateTime())->format('Y-m-d H:i:s');
    }

    public function value(): string
    {
        return $this->value;
    }
}