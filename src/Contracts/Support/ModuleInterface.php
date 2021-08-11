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

namespace EOffice\Contracts\Support;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface ModuleInterface
{
    public function build(ContainerBuilder $builder): void;

    public function getName(): string;

    public function getBaseDir(): string;
}
