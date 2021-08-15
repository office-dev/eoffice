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

use EOffice\Contracts\User\Model\UserInterface;
use EOffice\User\Model\Profile;

trait InteractsWithProfile
{
    protected function iDontHaveProfileForUser(UserInterface $user)
    {
        $em      = $this->getEntityManager();
        $profile = $em->getRepository(Profile::class)->findOneBy([
            'user' => $user->getId(),
        ]);
        if (null !== $profile) {
            $em->remove($profile);
            $em->flush();
        }
    }

    protected function iHaveProfileForUser(UserInterface $user, string $nama='Nama Profile', string $jabatan = 'Staff'): Profile
    {
        $em      = $this->getEntityManager();
        $profile = $em->getRepository(Profile::class)
            ->findOneBy([
                'user' => $user->getId(),
            ]);
        if (null === $profile) {
            $profile = new Profile($nama, $user);
            $em->persist($profile);
            $em->flush();
        }

        return $profile;
    }
}
