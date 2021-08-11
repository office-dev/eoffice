<?php

namespace Tests\EOffice\User\Listener;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use EOffice\Testing\TestCase;
use EOffice\User\Listener\UserListener;
use Mockery as m;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EOffice\Contracts\User\Model\UserInterface;

/**
 * @covers \EOffice\User\Listener\UserListener
 */
class UserListenerTest extends TestCase
{
    private UserListener $listener;
    private m\LegacyMockInterface|m\MockInterface|UserPasswordHasherInterface $hasher;
    private LifecycleEventArgs|m\LegacyMockInterface|m\MockInterface $args;
    private LifecycleEventArgs|m\LegacyMockInterface|m\MockInterface $user;
    private m\LegacyMockInterface|EntityManagerInterface|m\MockInterface $em;

    public function setUp(): void
    {
        parent::setUp();
        $this->hasher = m::mock(UserPasswordHasherInterface::class);
        $this->args = m::mock(LifecycleEventArgs::class);
        $this->user = m::mock(UserInterface::class);
        $this->em = m::mock(EntityManagerInterface::class);

        $this->listener = new UserListener($this->hasher);
    }

    public function test_it_should_listen_doctrine_events()
    {
        $listener = $this->listener;
        $subscribed = $listener->getSubscribedEvents();
        $this->assertContains('prePersist', $subscribed);
        $this->assertContains('preUpdate', $subscribed);
    }

    protected function configureUpdateUserMock()
    {
        $hasher = $this->hasher;
        $user = $this->user;
        $args = $this->args;

        $args->shouldReceive('getObject')
            ->once()->andReturn($user);
        $user->shouldReceive('getPlainPassword')
            ->once()->andReturn('password');
        $user->shouldReceive('setPassword')
            ->once()->with('hashed');
        $hasher->shouldReceive('hashPassword')
            ->with($user, 'password')->once()->andReturn('hashed');
    }

    public function test_it_should_hash_password_on_pre_persist_event()
    {
        $listener = $this->listener;
        $this->configureUpdateUserMock();
        $listener->prePersist($this->args);
    }

    public function test_it_should_hash_password_on_pre_update_event()
    {
        $listener = $this->listener;
        $em = $this->em;
        $args = $this->args;
        $user = $this->user;
        $meta = m::mock(ClassMetadata::class);
        $uow = m::mock(UnitOfWork::class);

        $this->configureUpdateUserMock();

        $args->shouldReceive('getObjectManager')
            ->once()->andReturn($em);
        $em->shouldReceive('getClassMetadata')
            ->with(get_class($user))
            ->once()->andReturn($meta);
        $em->shouldReceive('getUnitOfWork')
            ->once()->andReturn($uow);
        $uow->shouldReceive('recomputeSingleEntityChangeSet')
            ->with($meta,$user)->once();
        $listener->preUpdate($this->args);
    }
}
