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

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;
use EOffice\User\Fixtures\ProfileFixtures;
use EOffice\User\Fixtures\UserFixtures;

trait InteractsWithORM
{
    private static $databaseRefreshed = false;

    protected function refreshDatabase(): void
    {
        if (false === static::$databaseRefreshed) {
            $em   = $this->getEntityManager();
            $meta = $em->getMetadataFactory()->getAllMetadata();

            if ( ! empty($meta)) {
                $tool = new SchemaTool($em);
                $tool->dropSchema($meta);
                try {
                    $tool->createSchema($meta);
                } catch (ToolsException $e) {
                    throw new \InvalidArgumentException("Database schema is not buildable: {$e->getMessage()}", $e->getCode(), $e);
                }
            }
        }
    }

    protected function loadFixtures()
    {
        $databaseTool = $this->getContainer()
            ->get('liip_test_fixtures.services.fixtures_loader_factory')
            ->getFixtureLoader([UserFixtures::class, ProfileFixtures::class]);
        $manager = $this->getEntityManager();
        $databaseTool->getFixture(UserFixtures::class)->load($manager);
        $databaseTool->getFixture(ProfileFixtures::class)->load($manager);
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
