<?php

namespace App\User\Infrastructure\Persistence;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObjects\UserId;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

readonly class DoctrineUserRepository implements UserRepositoryInterface
{

    public function __construct(
        private EntityManager $entityManager
    ){}

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function findById(UserId $id): ?User
    {
        return $this->entityManager->find(User::class, $id->value());
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }
}