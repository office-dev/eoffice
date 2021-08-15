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

namespace EOffice\Testing\Concerns;

use Doctrine\Persistence\ObjectManager;

trait InteractsWithORM
{
    protected function getEntityManager(string $class = null): ObjectManager
    {
        if(null !== $class){
            return $this->getContainer()->get('doctrine')->getManagerForClass($class);
        }
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
