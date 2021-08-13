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

class Profile
{
    protected string $id;
    protected string $nama;
    protected string $userId;
    protected string $jabatanId;

    /**
     * Profile constructor.
     *
     * @param string $nama
     * @param string $userId
     * @param string $jabatanId
     */
    public function __construct(string $nama, string $userId, string $jabatanId)
    {
        $this->nama      = $nama;
        $this->userId    = $userId;
        $this->jabatanId = $jabatanId;
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
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getJabatanId(): string
    {
        return $this->jabatanId;
    }
}
