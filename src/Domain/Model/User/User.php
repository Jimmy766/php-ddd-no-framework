<?php

namespace App\Domain\Model\User;

class User{
    private $id;
    private $name;
    private $email;
    private $password;
    private $createdAt;

    public function __construct(UserId $id, Name $name, Email $email, Password $password){
        $this->id = $id->value();
        $this->name = $name->value();
        $this->email = $email->value();
        $this->password = $password->value();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): UserId{
        return new UserId($this->id);
    }

    public function getName(): Name{
        return new Name($this->name);
    }

    public function getEmail(): Email{
        return new Email($this->email);
    }

    public function vefifyPassword(string $password): bool{
        return password_verify($password, $this->password);
    }

    public function getCreatedAt(): \DateTimeImmutable{
        return $this->createdAt;
    }
}
