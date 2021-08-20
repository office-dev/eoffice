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

namespace EOffice\Passport\Listener;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UserCreatedEventListener
{
    private PasswordHasherInterface $hasher;

    public function __construct(
        PasswordHasherInterface $hasher
    ) {
        $this->hasher = $hasher;
    }
}
