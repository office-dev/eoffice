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

namespace Functional\EOffice\Core;

use EOffice\Core\Kernel;
use EOffice\Testing\FunctionalTestCase;

/**
 * @covers \EOffice\Core\Kernel
 */
class KernelTest extends FunctionalTestCase
{
    public function test_foo(): void
    {
        $container = $this->getContainer();

        /** @var Kernel $kernel */
        $kernel  = $container->get('kernel');
        $modules = $kernel->getModules();

        $this->assertArrayHasKey('user', $modules);
    }
}
