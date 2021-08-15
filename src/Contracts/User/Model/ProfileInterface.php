<?php

namespace EOffice\Contracts\User\Model;

use EOffice\Contracts\Organization\Model\JabatanInterface;
use EOffice\Contracts\Resource\ResourceInterface;

interface ProfileInterface extends ResourceInterface
{
    public function getUser(): ?UserInterface;
}
