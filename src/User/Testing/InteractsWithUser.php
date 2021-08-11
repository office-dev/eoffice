<?php

namespace EOffice\User\Testing;

use EOffice\Contracts\User\Model\UserInterface;
use EOffice\Testing\Concerns\InteractsWithORM;
use EOffice\User\Model\User;
use EOffice\User\Repository\UserRepository;

trait InteractsWithUser
{
    use InteractsWithORM;

    public function iHaveUser(string $username = 'test', string $email='test@example.org', string $password = 'test'): void
    {
        $repo = $this->getUserRepository();
        $user = $repo->findOneBy(['username' => $username]);
        if(null === $user){
            $user = new User($username, $email, $password);
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush($user);
        }

    }

    public function iDontHaveUser(string $username)
    {
        /** @var UserRepository $repo */
        $repo = $this->getUserRepository();
        $user = $repo->loadUserByUsername($username);
        if(null !== $user){
            $this->getEntityManager()->remove($user);;
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Doctrine\Persistence\ObjectRepository
     */
    public function getUserRepository()
    {
        return $this->getEntityManager()->getRepository(UserInterface::class);
    }
}
