<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Model\User\UserId;
use App\Domain\Model\User\Name;
use App\Domain\Model\User\Email;
use App\Domain\Model\User\Password;
use App\Domain\Model\User\User;

class UserTest extends TestCase
{
    public function testUserCreation()
    {
        $userId = new UserId(123);
        $name = new Name('John Doe');
        $email = new Email('example@email.com');
        $password = new Password('Password@123');
        $user = new User($userId, $name, $email, $password);

        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertTrue($user->vefifyPassword('Password@123'));
    
    }
}

