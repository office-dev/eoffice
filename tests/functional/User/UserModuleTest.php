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

namespace Functional\EOffice\User;

use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use EOffice\Contracts\User\Model\UserInterface;
use EOffice\Testing\Concerns\InteractsWithORM;
use EOffice\Testing\FunctionalTestCase;
use EOffice\User\Model\User;
use EOffice\User\Repository\UserRepository;
use EOffice\User\Testing\InteractsWithUser;

/**
 * @covers \EOffice\User\UserModule
 */
class UserModuleTest extends FunctionalTestCase
{
    use InteractsWithORM;
    use InteractsWithUser;

    public function test_it_should_load_user_model(): void
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->assertInstanceOf(
            ClassMetadata::class,
            $em->getClassMetadata(UserInterface::class)
        );
    }

    public function test_create_model()
    {
        $this->iDontHaveUser('test');
        $user = new User(
            'test',
            'test@example.org',
            'test'
        );
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();

        $this->assertNotNull($user->getId());

        $this->assertInstanceOf(
            UserRepository::class,
            $em->getRepository(User::class)
        );
    }
}
