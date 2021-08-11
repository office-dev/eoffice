<?php

namespace EOffice\Testing\Concerns;

use Doctrine\ORM\EntityManager;

trait InteractsWithORM
{
    public function getEntityManager(): EntityManager
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }
}
