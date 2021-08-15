<?php

/*
 * This file is part of the EOffice project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EOffice\Contracts\User\Model;

use EOffice\Contracts\Resource\ResourceInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

interface UserInterface extends ResourceInterface, PasswordAuthenticatedUserInterface, SecurityUserInterface
{
    public function getPassword(): ?string;

    public function getPlainPassword(): ?string;

    public function setPassword(string $password);

    public function getEmail(): string;

    public function getUsername(): string;
}
