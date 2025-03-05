<?php

namespace App\Application\UseCase\RegisterUser;

class RegisterUserResponse
{
    private $userId;
    private $name;
    private $email;
    private $message;

    public function __construct(string $userId, string $name, string $email, string $message)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message
        ];
    }
}
