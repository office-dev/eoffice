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

namespace Functional\EOffice\Passport;

use EOffice\Testing\ApiTestCase;
use EOffice\User\Testing\InteractsWithUser;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * @covers \EOffice\User\UserModule
 * @covers \EOffice\User\Repository\UserRepository
 */
class LoginApiTest extends ApiTestCase
{
    use InteractsWithUser;
    use RefreshDatabaseTrait;

    public function test_it_should_handle_user_login(): void
    {
        $this->iHaveUser();
        $response = static::createClient()->request('POST', '/api/login', ['json' => [
            'username' => 'test',
            'password' => 'test',
        ]]);

        $this->assertResponseIsSuccessful();
        $data = $response->toArray();
        $this->assertArrayHasKey('token', $data);
    }

    public function test_it_should_handle_invalid_login(): void
    {
        $client = static::createClient();
        $this->iHaveUser();
        $client->request('POST', '/api/login', ['json' => [
            'username' => 'test',
            'password' => 'foo',
        ]]);

        $this->assertResponseStatusCodeSame(401);
        $this->assertJsonContains(['message' => 'Invalid credentials.']);
    }
}
