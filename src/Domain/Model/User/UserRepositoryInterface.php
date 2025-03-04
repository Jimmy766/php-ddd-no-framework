<?php

namespace App\Domain\Model\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function getById(UserId $userId): ?User;
    public function getByEmail(Email $email): ?User;
    public function delete(User $user): void;
}
