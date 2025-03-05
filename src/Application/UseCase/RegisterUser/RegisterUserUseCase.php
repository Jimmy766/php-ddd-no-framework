<?php

namespace App\Application\UseCase\RegisterUser;

use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Model\User\User;
use App\Domain\Model\User\UserRepositoryInterface;
use App\Domain\Model\User\UserId;
use App\Domain\Model\User\Name;
use App\Domain\Model\User\Email;
use App\Domain\Model\User\Password;
use App\Domain\Exception\UserAlreadyExistsException;

class RegisterUserUseCase
{
    private $userRepository;

    private $listeners = [];

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function addDomainEventListener($listener)
    {
        $this->listeners[] = $listener;
    }

    public function notifyDomainEvent(UserRegisteredEvent $event)
    {
        foreach ($this->listeners as $listener) {
            call_user_func($listener, $event);
        }
    }

    public function __invoke(RegisterUserRequest $request)
    {
        $this->validateEmail(new Email($request->email()));
        $user = new User(
            new UserId($request->id()),
            new Name($request->name()),
            new Email($request->email()),
            new Password($request->password())
        );

        $this->userRepository->save($user);

        $this->notifyDomainEvent(new UserRegisteredEvent($user->getId()));

        return new RegisterUserResponse(
            $user->getId()->value(),
            $user->getName()->value(),
            $user->getEmail()->value(),
            'User registered successfully'
        );
    }

    private function validateEmail(Email $email)
    {
        $found = $this->userRepository->getByEmail($email);
        if ($found) {
            throw new UserAlreadyExistsException();
        }
    }
}
