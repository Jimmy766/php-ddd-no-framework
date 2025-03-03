<?php

namespace App\Domain\Exception;

class InvalidEmailException extends \DomainException
{
    public function __construct(string $message = 'Invalid email address'){
        parent::__construct($message);
    }
}
