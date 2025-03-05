<?php

namespace App\Application\UseCase\RegisterUser;

class RegisterUserRequest
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(
        string $id,
        string $name,
        string $email,
        string $password
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->email    = $email;
        $this->password = $password;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
