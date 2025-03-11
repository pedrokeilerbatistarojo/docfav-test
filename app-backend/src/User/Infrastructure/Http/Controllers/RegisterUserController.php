<?php

namespace App\User\Infrastructure\Http\Controllers;

class RegisterUserController
{
    public function __invoke()
    {
        return ["message" => "User registered successfully"];
    }
}