<?php
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Load routes
 */
$router = require __DIR__ . '/../config/routes.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

$response = $router->dispatch($method, $uri);
echo json_encode($response);