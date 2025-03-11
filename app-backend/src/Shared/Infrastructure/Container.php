<?php

namespace App\Shared\Infrastructure;

use App\User\Application\UsesCase\RegisterUserUseCase;
use App\User\Infrastructure\Http\Controllers\RegisterUserController;
use App\User\Infrastructure\Persistence\DoctrineUserRepository;
use Exception;

class Container
{
    private array $instances = [];

    /**
     * Handler the class instantiation
     * @throws Exception
     */
    public function get(string $className)
    {
        if (isset($this->instances[$className])) {
            return $this->instances[$className];
        }

        if ($className === RegisterUserController::class) {
            $useCase = $this->get(RegisterUserUseCase::class);
            return $this->instances[$className] = new RegisterUserController($useCase);
        }

        if ($className === RegisterUserUseCase::class) {
            $repository = $this->get(DoctrineUserRepository::class);
            return $this->instances[$className] = new RegisterUserUseCase($repository);
        }

        if ($className === DoctrineUserRepository::class) {
            global $entityManager;
            return $this->instances[$className] = new DoctrineUserRepository($entityManager);
        }

        throw new Exception("Class {$className} not found in container");
    }
}