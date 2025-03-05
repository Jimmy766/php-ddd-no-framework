<?php

namespace App\Domain\Model\User;

use App\Domain\Exception\WeakPasswordException;

class Password{
    private $value;

    public function __construct(string $value){
        $this->assertValidPassword($value);
        $this->value = password_hash($value, PASSWORD_DEFAULT);
    }

    private function assertValidPassword(string $password): void{
        if(strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[\d]/', $password) ||
            !preg_match('/[\W]/', $password)
        ){
            throw new WeakPasswordException();
        }
    }

    public function verfy(string $password): bool{
        return password_verify($password, $this->value);
    }

    public function value(): string{
        return $this->value;
    }

    public function equals(Password $password): bool{
        return $this->value() === $password->value();
    }

    public function __toString(): string{
        return $this->value();
    }
}
