<?php

namespace App\User\Domain\Repository;

interface UserRepository
{
    public function save(User $user): void;

    public function searchAll(): array;

    public function matching(Criteria $criteria): array;
}