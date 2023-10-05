<?php

namespace App\Exceptions;

class BookNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Книга не найдена.');
    }
}
