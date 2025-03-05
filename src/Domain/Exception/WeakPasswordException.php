<?php

namespace App\Domain\Exception;

class WeakPasswordException extends \DomainException
{
    public function __construct(string $message = 'Weak password')
    {
        parent::__construct($message);
    }
}
