<?php

namespace EOffice\User\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use EOffice\User\Model\Profile;
use EOffice\User\Model\User;

class ProfileFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)
            ->findOneBy(['username' => 'test']);

        $profile = new Profile('Test Profile', $user->getId(), 'jabatan');
        $manager->persist($profile);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
