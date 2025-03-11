<?php

namespace App\User\Application\UsesCase;

use App\Shared\Domain\Utils;
use App\User\Application\DTO\RegisterUserRequest;
use App\User\Application\DTO\UserResponseDTO;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObjects\UserCreatedAt;
use App\User\Domain\ValueObjects\UserEmail;
use App\User\Domain\ValueObjects\UserId;
use App\User\Domain\ValueObjects\UserName;
use App\User\Domain\ValueObjects\UserPassword;
use Exception;

final readonly class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    /**
     * Execute register user
     * @throws Exception
     */
    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $userId = new UserId(Utils::generateUuid());
        $userName = new UserName($request->name);
        $userEmail = new UserEmail($request->email);
        $userPassword = new UserPassword($request->password);
        $userCreatedAt = new UserCreatedAt();

        $user = new User($userId, $userName, $userEmail, $userPassword, $userCreatedAt);

        $this->repository->save($user);

        $response = new UserResponseDTO($user->id(), $user->name(), $user->email(), $user->createdAt());

        return $response;
    }
}