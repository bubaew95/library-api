<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class SubscriberRequest
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\IsTrue]
    public bool $agreed;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isAgreed(): bool
    {
        return $this->agreed;
    }

    public function setAgreed(bool $agreed): void
    {
        $this->agreed = $agreed;
    }
}
