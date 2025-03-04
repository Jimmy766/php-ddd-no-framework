<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use App\Domain\Model\User\User;
use App\Domain\Model\User\UserId;
use App\Domain\Model\User\Name;
use App\Domain\Model\User\Email;
use App\Domain\Model\User\Password;
use App\Infrastructure\Doctrine\DoctrineUserRepository;

class DoctrineUserRepositoryTest extends TestCase
{
    private $entityManager;
    private $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->getTestEntityManager();

        $tool = new SchemaTool($this->entityManager);
        $classes = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $tool->createSchema($classes);

        $this->repository = new DoctrineUserRepository($this->entityManager);
    }

    protected function tearDown(): void
    {
        $tool = new SchemaTool($this->entityManager);
        $classes = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $tool->dropSchema($classes);

        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testSaveAndFindById(): void
    {
        $user = new User(
            new UserId(123),
            new Name('Juan Perez'),
            new Email('juan@example.com'),
            new Password('Str0ng@Pass1')
        );

        $this->repository->save($user);

        $found = $this->repository->getById(new UserId(123));

        $this->assertNotNull($found);
        $this->assertEquals(123, $found->getId()->value());
        $this->assertEquals('Juan Perez', $found->getName()->value());
        $this->assertEquals('juan@example.com', $found->getEmail()->value());
    }

    public function testFindByEmail(): void
    {
        $userA = new User(
            new UserId(1),
            new Name('Alice'),
            new Email('alice@example.com'),
            new Password('StroNg@Pass2')
        );
        $userB = new User(
            new UserId(2),
            new Name('Bob'),
            new Email('bob@example.com'),
            new Password('AnotherStr0ngPass!')
        );

        $this->repository->save($userA);
        $this->repository->save($userB);

        $foundA = $this->repository->getByEmail(new Email('alice@example.com'));
        $foundB = $this->repository->getByEmail(new Email('bob@example.com'));

        $this->assertNotNull($foundA);
        $this->assertNotNull($foundB);
        $this->assertEquals(1, $foundA->getId()->value());
        $this->assertEquals(2, $foundB->getId()->value());
    }


    public function testDeleteUser(): void
    {

        $user = new User(
            new UserId(321),
            new Name('To Delete'),
            new Email('delete@example.com'),
            new Password('D3l3teMe@!')
        );
        $this->repository->save($user);
        $this->repository->delete($user);
        $foundAgain = $this->repository->getById(new UserId(321));
        $this->assertNull($foundAgain);
    }

    private function getTestEntityManager(): EntityManagerInterface
    {
        $config = \Doctrine\ORM\Tools\Setup::createYAMLMetadataConfiguration(
            [__DIR__ . '/../../src/Infrastructure/Doctrine'],
            true
        );

        $params = [
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ];

        return \Doctrine\ORM\EntityManager::create($params, $config);
    }
}
