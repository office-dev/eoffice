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

namespace EOffice\Testing;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase as BaseTestCase;
use EOffice\Testing\Concerns\InteractsWithORM;

abstract class ApiTestCase extends BaseTestCase
{
    use InteractsWithORM;

    protected function setUp(): void
    {
        parent::setUp();
    }
}
