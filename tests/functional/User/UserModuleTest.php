<?php

namespace Functional\EOffice\User;

use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\Mapping\ClassMetadata;
use EOffice\Contracts\User\Model\UserInterface;
use EOffice\Testing\Concerns\InteractsWithORM;
use EOffice\User\Model\User;
use EOffice\User\Repository\UserRepository;
use EOffice\User\Testing\InteractsWithUser;
use EOffice\User\UserModule;
use EOffice\Testing\FunctionalTestCase;

/**
 * @covers \EOffice\User\UserModule
 */
class UserModuleTest extends FunctionalTestCase
{
    use InteractsWithORM,
        InteractsWithUser;

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
