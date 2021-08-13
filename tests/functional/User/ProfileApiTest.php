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

use EOffice\Testing\ApiTestCase;
use EOffice\User\Model\Profile;
use EOffice\User\Testing\InteractsWithProfile;
use EOffice\User\Testing\InteractsWithUser;

/**
 * @covers \EOffice\User\Model\Profile
 */
class ProfileApiTest extends ApiTestCase
{
    use InteractsWithUser;
    use InteractsWithProfile;

    public function test_create_profile()
    {
        $user = $this->iHaveUser('admin');
        $client = $this->iHaveLoggedInAsUser('admin', 'admin');

        $response = $client->request('POST', '/api/profiles', ['json' => [
            'nama' => 'Bagong Handoko',
            'userId' => $user->getId(),
            'jabatanId' => 'Operator',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains(['nama' => 'Bagong Handoko']);

        $json = $response->toArray();
        $this->assertArrayHasKey('nama', $json);
        $this->assertArrayHasKey('userId', $json);
    }

    public function test_get_profile()
    {
        // login dulu sebelum edit profile
        $user = $this->iHaveUser('test');
        $profile = $this->iHaveProfileForUser($user);
        $client = $this->iHaveLoggedInAsUser('test', 'test');

        // update profile dengan method: PUT , dan profile id
        // Ingat! Sesuai dokumentasi api yang digunakan adalah profile id
        $iri = $this->findIriBy(Profile::class, ['id' => $profile->getId()]);
        $client->request('PUT', $iri,['json' => [
            'nama' => 'Nama Edited',
            'jabatanId' => $profile->getJabatanId()
        ]]);

        $this->assertResponseIsSuccessful('foo');
    }
}
