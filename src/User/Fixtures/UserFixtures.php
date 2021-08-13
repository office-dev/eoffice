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

namespace EOffice\User\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use EOffice\User\Model\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adminUser = new User('admin', 'admin@example.org', 'admin', ['ROLE_USER', 'ROLE_ADMIN']);
        $manager->persist($adminUser);

        $testUser = new User('test', 'test@example.org', 'test');
        $manager->persist($testUser);

        $manager->flush();
    }
}
