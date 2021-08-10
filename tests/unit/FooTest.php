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

namespace Tests\EOffice;

use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    public function test_foo(): void
    {
        $this->assertSame('foo', 'foo');
    }
}
