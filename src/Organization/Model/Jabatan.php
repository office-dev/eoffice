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

namespace EOffice\Organization\Model;

use EOffice\Contracts\Organization\Model\JabatanInterface;

class Jabatan implements JabatanInterface
{
    protected string $id;
    protected string $nama;

    public function __construct(string $nama)
    {
        $this->nama = $nama;
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
}
