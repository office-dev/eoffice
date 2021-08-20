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

namespace EOffice\Testing\Concerns;

trait InteractsWithResourceProperties
{
    /**
     * @param string                  $propertyName
     * @param mixed|string|array|null $value
     * @dataProvider getPropertiesToTests
     */
    public function testMutableProperties(string $propertyName, $value): void
    {
        $class = $this->getResourceClassName();
        $ob    = new $class('test', 'test');

        $setter = 'set'.$propertyName;
        $getter = 'get'.$propertyName;

        \call_user_func([$ob, $setter], $value);
        $this->assertSame($value, \call_user_func([$ob, $getter]));
    }

    abstract public function getPropertiesToTests(): array;

    /**
     * @return string|class-string
     */
    abstract protected function getResourceClassName(): string;
}
