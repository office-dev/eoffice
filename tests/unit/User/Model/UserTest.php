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

namespace Tests\EOffice\User\Model;

use EOffice\Testing\Concerns\InteractsWithResourceProperties;
use EOffice\Testing\TestCase;
use EOffice\User\Model\User;

/**
 * @covers \EOffice\User\Model\User
 */
class UserTest extends TestCase
{
    use InteractsWithResourceProperties;

    public function getPropertiesToTests(): array
    {
        return [
            ['username', 'foo'],
            ['email', 'me@itstoni.org'],
            ['createdAt', new \DateTimeImmutable()],
        ];
    }

    protected function getResourceClassName(): string
    {
        return User::class;
    }
}
