<?php

namespace App\User\Infrastructure\Http\Controllers;

use App\User\Application\DTO\RegisterUserRequest;
use App\User\Application\UsesCase\RegisterUserUseCase;

final readonly class RegisterUserController
{
    public function __construct(
        private RegisterUserUseCase $registerUserUseCase
    ){}

    public function __invoke()
    {
        // Get body to the request
        $data = json_decode(file_get_contents('php://input'), true);

        //Process the register use case
        try {
            $this->registerUserUseCase->execute(new RegisterUserRequest(
                $data['name'],
                $data['email'],
                $data['password']
            ));

            return json_encode(["message" => "User registered successfully"]);

        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(["error" => $e->getMessage()]);
        }
    }
}