<?php

namespace App\Domain\Model\User;

class UserId{
    private $value;

    public function __construct(int $value){
        $this->value = $value;
    }

    public function value(): int{
        return $this->value;
    }

    public function equals(UserId $userId): bool{
        return $this->value() === $userId->value();
    }

    public function __toString(): string{
        return (string) $this->value();
    }
}
