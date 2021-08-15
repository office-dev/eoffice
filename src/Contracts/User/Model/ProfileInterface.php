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

interface ProfileInterface extends ResourceInterface
{
    public function getUser(): ?UserInterface;
}
