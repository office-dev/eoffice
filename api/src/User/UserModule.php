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

namespace EOffice\User;

use EOffice\Contracts\Support\ModuleInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UserModule implements ModuleInterface
{
    public function build(ContainerBuilder $builder): void
    {
    }

    public function getName(): string
    {
        return 'user';
    }

    public function getBaseDir(): string
    {
        return realpath(__DIR__);
    }
}
