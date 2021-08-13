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

namespace EOffice\User\Testing;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use EOffice\Contracts\User\Model\UserInterface;
use EOffice\Testing\Concerns\InteractsWithORM;
use EOffice\User\Model\User;
use EOffice\User\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait InteractsWithUser
{
    use InteractsWithORM;

    /**
     * @param UserInterface $user
     * @return Client
     */
    protected function iHaveLoggedInAsUser(string $userName, string $password): Client
    {
        $response = static::createClient()->request('POST', '/login', ['json' => [
            'username' => $userName,
            'password' => $password,
        ]]);
        $data = json_decode($response->getContent());
        $token = $data->token;
        return static::createClient([], ['headers' => ['authorization' => 'Bearer '.$token]]);
    }

    protected function iHaveUser(string $username = 'test', string $email='test@example.org', string $password = 'test'): UserInterface
    {
        $repo = $this->getUserRepository();
        $user = $repo->findOneBy(['username' => $username]);
        if (null === $user) {
            $user = new User($username, $email, $password);
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush($user);
        }
        return $user;
    }

    protected function iDontHaveUser(string $username)
    {
        /** @var UserRepository $repo */
        $repo = $this->getUserRepository();
        $user = $repo->loadUserByUsername($username);
        if (null !== $user) {
            $this->getEntityManager()->remove($user);
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Doctrine\Persistence\ObjectRepository
     */
    protected function getUserRepository()
    {
        return $this->getEntityManager()->getRepository(UserInterface::class);
    }
}
