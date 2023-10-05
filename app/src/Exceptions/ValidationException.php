<?php

namespace App\Exceptions;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{

    public function __construct(private readonly ConstraintViolationListInterface $violations)
    {}

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
