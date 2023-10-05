<?php

namespace App\Listener;

use App\Exceptions\ValidationException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;

class ValidationExceptionListener
{
    public function __construct(private readonly SerializerInterface $serializer)
    {}

    public function __invoke(ExceptionEvent $event)
    {
        $throwable = $event->getThrowable();

        if(!($throwable instanceof ValidationException)) {
            return;
        }

        $data = $this->serializer->serialize(
            new ErrorResponse($)
        );
    }
}
