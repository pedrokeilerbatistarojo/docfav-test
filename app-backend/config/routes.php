<?php

use App\Shared\Infrastructure\Container;
use App\Shared\Infrastructure\Routes\Router;
use App\User\Infrastructure\Http\Controllers\RegisterUserController;

$router = new Router();
$container = new Container();

$router->add('GET', '/', function () {
    return json_encode(["message" => "Welcome"]);
});

try {
    $router->add('POST', '/register', $container->get(RegisterUserController::class));
} catch (Exception $e) {
    error_log("Error getting container class: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}

return $router;
