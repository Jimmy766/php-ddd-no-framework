<?php

namespace App\Infrastructure\Controller;

use App\Application\UseCase\RegisterUser\RegisterUserRequest;
use App\Application\UseCase\RegisterUser\RegisterUserResponse;
use App\Application\UseCase\RegisterUser\RegisterUserUseCase;

class RegisterUserController
{
    private $useCase;

    public function __construct(RegisterUserUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(array $request)
    {
        $id       = $request['id']?? '';
        $name     = $request['name']?? '';
        $email    = $request['email']?? '';
        $password = $request['password']?? '';

        $registerUserRequest = new RegisterUserRequest($id, $name, $email, $password);

        try {
            $response = ($this->useCase)($registerUserRequest);
            header('content-type: application/json', true, 200);
            return json_encode(['user' => $response->toArray()]);
        } catch (\Exception $e) {
            header('content-type: application/json', true, 400);
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
