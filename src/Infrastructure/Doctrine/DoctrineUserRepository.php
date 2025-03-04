<?php

namespace App\Infrastructure\Doctrine;

use App\Domain\Model\User\User;
use App\Domain\Model\User\UserId;
use App\Domain\Model\User\Name;
use App\Domain\Model\User\Email;
use App\Domain\Model\User\Password;
use App\Domain\Model\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function getById(UserId $userId): ?User{
        return $this->entityManager->getRepository(User::class)->find($userId->value());
    }

    public function getByEmail(Email $email): ?User{
        return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email->value()]);
    }

    public function delete(User $user): void{
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

}
