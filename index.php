<?php

declare(strict_types=1);

use App\Application\UseCase\RegisterUser\RegisterUserUseCase;
use App\Infrastructure\Controller\RegisterUserController;
use App\Infrastructure\Doctrine\DoctrineUserRepository;

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

$userRepository = new DoctrineUserRepository($entityManager);

$useCase = new RegisterUserUseCase($userRepository);
$useCase->addDomainEventListener(function ($event) {
    // hacer algo con el evento,
    // magia negra tal vez
});

$controller = new RegisterUserController($useCase);
$requestData = [
    'id'       => $_POST['id']       ?? '',
    'name'     => $_POST['name']     ?? '',
    'email'    => $_POST['email']    ?? '',
    'password' => $_POST['password'] ?? '',
];

echo $controller($requestData);

