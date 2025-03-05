<?php

namespace App\Domain\Event;

use App\Domain\Model\User\UserId;

class UserRegisteredEvent
{
    private $userId;
    private $occurredOn;
    
    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
