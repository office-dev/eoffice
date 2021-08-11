<?php

namespace EOffice\User\Listener;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EOffice\Contracts\User\Model\UserInterface;

class UserListener implements EventSubscriberInterface
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if($object instanceof UserInterface){
            $this->updateUserFields($object);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if($object instanceof UserInterface){
            $this->updateUserFields($object);
            $this->recomputeChangeSet($args->getObjectManager(), $object);
        }
    }

    private function updateUserFields(UserInterface $user)
    {
        $plain = $user->getPlainPassword();
        if(null !== $plain){
            $hasher = $this->hasher;
            $password = $hasher->hashPassword($user, $plain);
            $user->setPassword($password);
        }
    }

    private function recomputeChangeSet(EntityManagerInterface|ObjectManager $em, UserInterface $user)
    {
        $meta = $em->getClassMetadata(get_class($user));

        /** @var EntityManagerInterface $em */
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $user);
    }
}
