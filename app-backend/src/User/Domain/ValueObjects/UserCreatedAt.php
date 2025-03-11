<?php

namespace App\User\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class UserCreatedAt
{
    private string $value;

    public function __construct(?string $date = null)
    {
        if ($date === null) {
            $this->value = (new DateTime())->format('Y-m-d H:i:s');
        } else {
            $this->ensureValidDate($date);
            $this->value = $date;
        }
    }

    private function ensureValidDate(string $date): void
    {
        if (!DateTime::createFromFormat('Y-m-d H:i:s', $date)) {
            throw new InvalidArgumentException("Invalid date format, expected Y-m-d H:i:s");
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}