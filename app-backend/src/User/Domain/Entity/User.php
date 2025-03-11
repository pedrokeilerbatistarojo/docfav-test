<?php

namespace App\User\Domain\Entity;

use App\User\Domain\ValueObjects\UserCreatedAt;
use App\User\Domain\ValueObjects\UserEmail;
use App\User\Domain\ValueObjects\UserId;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;

final readonly class User
{
    public function __construct(
        private UserId        $id,
        private UserName      $name,
        private UserEmail     $email,
        private UserPassword  $password,
        private UserCreatedAt $createdAt
    ) {}

    public static function fromPrimitives(array $primitives): self
    {
        return new self(
            new UserId($primitives['id']),
            new UserName($primitives['name']),
            new UserEmail($primitives['email']),
            new UserPassword($primitives['password']),
            new UserCreatedAt()
        );
    }

    public function toPrimitives(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'createdAt' => $this->createdAt->value()
        ];
    }

    public function id(): string
    {
        return $this->id->value();
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function email(): string
    {
        return $this->email->value();
    }

    public function createdAt(): string
    {
        return $this->createdAt->value();
    }
}

