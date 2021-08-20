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

namespace Integration\EOffice\Context;

use Behat\Behat\Context\Context;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use EOffice\Contracts\User\Model\UserInterface;
use EOffice\User\Model\User;
use EOffice\User\Repository\UserRepository;

class UserContext implements Context
{
    /**
     * @var ObjectManager
     */
    private $userManager;

    public function __construct(ManagerRegistry $registry)
    {
        $this->userManager = $registry->getManagerForClass(User::class);
    }

    /**
     * @Given there is a user :email identified by :password
     * @Given there was account of :email with password :password
     * @Given there is a user :email
     *
     * @param mixed $email
     * @param mixed $password
     */
    public function thereIsUserIdentifiedBy($email, $password = 'eoffice'): void
    {
        /** @var UserRepository $repo */
        $repo = $this->getUserRepository();
        $om   = $this->userManager;
        $user = $repo->loadUserByIdentifier($email);

        if (null === $user) {
            $user = new User('test', $email, $password);
            $om->persist($user);
            $om->flush();
        }
    }

    /**
     * @return ObjectRepository|UserRepository
     */
    protected function getUserRepository()
    {
        return $this->userManager->getRepository(UserInterface::class);
    }
}
