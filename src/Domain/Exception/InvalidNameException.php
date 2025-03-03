<?php

namespace App\Domain\Exception;

class InvalidNameException extends \DomainException
{
    public function __construct(string $message = 'Invalid name')
    {
        parent::__construct($message);
    }
}
