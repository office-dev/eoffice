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

namespace Tests\EOffice\Core\Application;

use EOffice\Core\Application\Kernel;
use EOffice\Testing\TestCase;

class TestKernel extends Kernel
{
    public function __construct(string $environment, bool $debug)
    {
        parent::__construct($environment, $debug);
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/eoffice/tests/cache';
    }
}

/**
 * @covers \EOffice\Core\Application\Kernel
 */
class KernelTest extends TestCase
{
    public function test_it_should_load_modules()
    {
        $kernel = new TestKernel('prototype', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $this->assertIsObject($container);
    }
}
