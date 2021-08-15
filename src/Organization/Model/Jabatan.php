<?php

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
