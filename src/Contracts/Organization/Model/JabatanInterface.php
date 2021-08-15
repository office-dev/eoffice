<?php

namespace EOffice\Contracts\Organization\Model;

use EOffice\Contracts\Resource\ResourceInterface;

interface JabatanInterface extends ResourceInterface
{
    public function getNama(): string;
}
