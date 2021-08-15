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

namespace Functional\EOffice\User;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use EOffice\Testing\Concerns\InteractsWithORM;
use EOffice\User\Testing\InteractsWithUser;

/**
 * @covers \EOffice\User\Model\User
 * @covers \EOffice\User\UserModule
 */
class UserApiTest extends ApiTestCase
{
    use InteractsWithORM;
    use InteractsWithUser;

    private Client $client;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->client = static::createClient();
    }

    public function test_create_user()
    {
        $response = $this->client->request('POST', '/api/users', ['json' => [
            'username' => 'create',
            'email' => 'create@example.org',
            'plainPassword' => 'create',
        ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains(['username' => 'create']);

        $json = $response->toArray();
        $this->assertArrayNotHasKey('password', $json);
        $this->assertArrayNotHasKey('plainPassword', $json);
        //$this->assertSame('foo', $response->toArray());
    }
}
