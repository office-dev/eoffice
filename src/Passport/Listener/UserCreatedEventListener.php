<?php

namespace EOffice\Passport\Listener;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;


class UserCreatedEventListener
{
    private PasswordHasherInterface $hasher;

    public function __construct(
        PasswordHasherInterface $hasher
    )
    {
        $this->hasher = $hasher;
    }
}
