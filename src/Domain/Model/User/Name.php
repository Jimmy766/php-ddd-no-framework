<?php

namespace App\Domain\Model\User;

use App\Domain\Exception\InvalidNameException;

class Name{
    private $value;

    public function __construct(string $value){
        $this->assertValidName($value);
        $this->value = $value;
    }

    private function assertValidName(string $name): void{
        $trimmed = trim($name);
        if(strlen($trimmed) < 3){
            throw new InvalidNameException("Invalid name: $name, must be at least 3 characters long");
        }
    }

    public function value(): string{
        return $this->value;
    }

    public function equals(Name $name): bool{
        return $this->value() === $name->value();
    }

    public function __toString(): string{
        return $this->value();
    }
}
