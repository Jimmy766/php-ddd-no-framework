<?php

declare(strict_types=1);

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/vendor/autoload.php';

$paths = [__DIR__ . '/src/Infrastructure/Doctrine'];
$isDevMode = true;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'ddd_user',
    'password' => 'ddd_pass',
    'dbname'   => 'ddd_test',
    'host'     => 'db',
];

$config = \Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);

