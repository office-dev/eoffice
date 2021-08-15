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

namespace EOffice\User\Model;

use EOffice\Contracts\Organization\Model\JabatanInterface;
use EOffice\Contracts\User\Model\ProfileInterface;
use EOffice\Contracts\User\Model\UserInterface;

class Profile implements ProfileInterface
{
    protected string $id;
    protected string $nama;
    protected ?UserInterface $user;

    /**
     * @param string           $nama
     * @param UserInterface    $user
     * @param JabatanInterface $jabatan
     */
    public function __construct(string $nama, UserInterface $user = null)
    {
        $this->nama      = $nama;
        $this->user      = $user;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNama(): string
    {
        return $this->nama;
    }

    /**
     * @param string $nama
     */
    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }

    /**
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * @param UserInterface|null $user
     */
    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;
    }
}
