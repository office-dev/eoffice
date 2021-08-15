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

namespace EOffice\User\Fixtures;

use Doctrine\Bundle\DoctrineBundle\Registry;
use EOffice\Contracts\Organization\Model\JabatanInterface;
use EOffice\Contracts\User\Model\ProfileInterface;
use EOffice\Contracts\User\Model\UserInterface;
use EOffice\Organization\Model\Jabatan;
use EOffice\User\Model\Profile;
use EOffice\User\Model\User;

class UserLoader
{
    private Registry $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function createUser(string $username, string $email, string $password): UserInterface
    {
        return new User($username, $email, $password);
    }

    public function createProfile(string $nama, UserInterface $user): ProfileInterface
    {
        return new Profile($nama, $user);
    }

    public function createJabatan(string $nama): JabatanInterface
    {
        return new Jabatan($nama);
    }
}
