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

use EOffice\Testing\TestCase;
use Fixtures\EOffice\TestModule;

/**
 * @covers \EOffice\Core\Application\ModuleTrait
 */
class ModuleTest extends TestCase
{
    public function test_it_should_return_module_name()
    {
        $module = new TestModule();
        $this->assertSame('test', $module->getName());
    }

    public function test_it_should_return_base_dir()
    {
        $module = new TestModule();
        $r      = new \ReflectionClass($module);

        $this->assertSame(
            \dirname($r->getFileName()),
            $module->getBaseDir()
        );
    }
}
