<?php

use App\Shared\Infrastructure\Routes\Router;
use App\User\Infrastructure\Http\Controllers\RegisterUserController;

$router = new Router();

$router->add('GET', '/', function () {
    return json_encode(["message" => "Welcome"]);
});

$router->add('POST', '/register', new RegisterUserController());

return $router;
