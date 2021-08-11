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

namespace EOffice\User\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername(string $username)
    {
        $em  = $this->getentityManager();
        $dql = <<<EOC
SELECT u
FROM EOffice\Contracts\User\Model\UserInterface u
WHERE u.username = :query
OR u.email = :query
EOC;

        $user = $em->createQuery($dql)
            ->setParameter('query', $username)
            ->getOneOrNullResult();

        \assert($user instanceof UserInterface);

        return $user;
    }
}
