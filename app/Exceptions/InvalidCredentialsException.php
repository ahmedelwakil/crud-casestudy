<?php

namespace App\Exceptions;

class InvalidCredentialsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid Credentials!');
    }
}
