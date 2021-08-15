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

use EOffice\Core\Application\Kernel;
use EOffice\Testing\FunctionalTestCase;
use EOffice\User\Model\User;

/**
 * @covers \EOffice\Core\Application\Kernel
 */
class KernelTest extends FunctionalTestCase
{
    public function test_module_loading(): void
    {
        $container = $this->getContainer();

        /** @var \EOffice\Core\Application\Kernel $kernel */
        $kernel  = $container->get('kernel');
        $modules = $kernel->getModules();

        $this->assertArrayHasKey('user', $modules);
    }
}
