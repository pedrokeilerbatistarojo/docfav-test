<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = [__DIR__ . '/../src/User/Infrastructure/Persistence/Mappings'];
$isDevMode = true;
$env = parse_ini_file(__DIR__ . '/../.env');

$dbParams = [
    'driver'   => $env['DB_DRIVER'],
    'user'     => $env['DB_USER'],
    'password' => $env['DB_PASSWORD'],
    'dbname'   => $env['DB_NAME'],
    'host'     => $env['DB_HOST'],
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;