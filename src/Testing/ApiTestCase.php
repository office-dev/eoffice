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

namespace EOffice\Testing;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase as BaseTestCase;

class ApiTestCase extends BaseTestCase
{
    protected ?string $token = null;
    protected function createClientWithCredentials()
    {
        $token = $this->getToken();
        return $this->createClient([], ['headers' => ['authorization' => 'Bearer '.$token]]);
    }

    /**
     * Use other credentials if needed.
     */
    protected function getToken($body = []): string
    {
        if ($this->token) {
            return $this->token;
        }

        $response = $this->createClient()->request('POST', '/login', ['json' => [
            'username' => 'test',
            'password' => 'test',
        ]]);

        $this->assertResponseIsSuccessful();
        $data = json_decode($response->getContent());
        $this->token = $data->token;
        return $data->token;
    }
}
