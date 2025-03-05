<?php

namespace App\Domain\Model\User;

class Email{
    private $value;

    public function __construct(string $value){
        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            throw new \InvalidEmailException("Invalid email address: $value");
        }
        $this->value = $value;
    }

    public function value(): string{
        return $this->value;
    }

    public function equals(Email $email): bool{
        return $this->value() === $email->value();
    }

    public function __toString(): string{
        return $this->value();
    }
}
