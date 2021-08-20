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

namespace EOffice\User\Listener;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use EOffice\Contracts\User\Model\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof UserInterface) {
            $this->updateUserFields($object);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof UserInterface) {
            /** @var EntityManagerInterface $em */
            $em = $args->getObjectManager();

            $this->updateUserFields($object);
            $this->recomputeChangeSet($em, $object);
        }
    }

    private function updateUserFields(UserInterface $user)
    {
        $plain = $user->getPlainPassword();
        if (null !== $plain) {
            $hasher   = $this->hasher;
            $password = $hasher->hashPassword($user, $plain);
            $user->setPassword($password);
        }
    }

    private function recomputeChangeSet(EntityManagerInterface $em, UserInterface $user)
    {
        $meta = $em->getClassMetadata(\get_class($user));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $user);
    }
}
