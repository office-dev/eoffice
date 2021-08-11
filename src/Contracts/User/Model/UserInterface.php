<?php

namespace EOffice\Contracts\User\Model;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

interface UserInterface extends
    PasswordAuthenticatedUserInterface,
    SecurityUserInterface
{
    public function getPlainPassword(): ?string;
    public function setPassword(string $password);
}
