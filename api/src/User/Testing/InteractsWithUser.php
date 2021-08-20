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
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use EOffice\Contracts\User\Model\UserInterface;
use EOffice\Testing\Concerns\InteractsWithORM;
use EOffice\User\Model\User;
use EOffice\User\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\Cookie;

trait InteractsWithUser
{
    use InteractsWithORM;

    /**
     * @param string $username
     * @param string $password
     *
     * @return Client|KernelBrowser
     */
    protected function iHaveLoggedInAsUser(string $username, string $password)
    {
        /** @var Response $response */
        $response = static::createClient()->request('POST', '/api/login', ['json' => [
            'username' => $username,
            'password' => $password,
        ]]);

        $cookies = $response->getHeaders()['set-cookie'];
        $jwt_hp  = str_replace('jwt_hp=', '', explode(';', $cookies[0])[0]);
        $jwt_s   = str_replace('jwt_s=', '', explode(';', $cookies[1])[0]);

        /** @var Client $client */
        $client = static::createClient();
        $client->getCookieJar()->set(new Cookie('jwt_hp', $jwt_hp));
        $client->getCookieJar()->set(new Cookie('jwt_s', $jwt_s));

        return $client;
    }

    protected function iHaveUser(string $username = 'test', string $email='test@example.org', string $password = 'test'): UserInterface
    {
        $repo = $this->getUserRepository();
        $user = $repo->findOneBy(['username' => $username]);
        $em   = $this->getUserEntityManager();
        if (null === $user) {
            $user = new User($username, $email, $password);
            $em->persist($user);
            $em->flush();
        }

        $em->refresh($user);

        return $user;
    }

    protected function iDontHaveUser(string $username): void
    {
        /** @var UserRepository $repo */
        $repo = $this->getUserRepository();
        $user = $repo->loadUserByIdentifier($username);
        $em   = $this->getUserEntityManager();
        if (null !== $user) {
            $em->remove($user);
            $em->flush();
        }
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Doctrine\Persistence\ObjectRepository
     */
    protected function getUserRepository()
    {
        return $this->getEntityManager()->getRepository(UserInterface::class);
    }

    public function getUserEntityManager()
    {
        $model = (string) $this->getContainer()->getParameter('eoffice.user.models.user');

        return $this->getEntityManager($model);
    }
}
