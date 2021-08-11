<?php

namespace EOffice\User\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use EOffice\Resource\Repository\ResourceRepository;
use EOffice\User\Model\User;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use EOffice\Contracts\User\Model\UserInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{

    public function loadUserByUsername(string $username): ?object
    {
        $em = $this->getentityManager();
        $dql = <<<EOC
SELECT u
FROM EOffice\Contracts\User\Model\UserInterface u
WHERE u.username = :query
OR u.email = :query
EOC;

        return $em->createQuery($dql)
            ->setParameter('query', $username)
            ->getOneOrNullResult();
    }
}
