<?php

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

        $testUser = new User('test', 'test@example.org','test');
        $manager->persist($testUser);

        $manager->flush();
    }
}
