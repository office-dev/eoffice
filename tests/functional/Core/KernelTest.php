<?php

namespace Functional\EOffice\Core;

use EOffice\Core\Kernel;
use EOffice\Testing\FunctionalTestCase;

/**
 * @covers \EOffice\Core\Kernel
 */
class KernelTest extends FunctionalTestCase
{
    public function testFoo(): void
    {
        $container = $this->getContainer();

        /** @var Kernel $kernel */
        $kernel = $container->get('kernel');
        $modules = $kernel->getModules();

        $this->assertArrayHasKey('user', $modules);
    }
}
