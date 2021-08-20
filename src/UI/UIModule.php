<?php

namespace EOffice\UI;

use EOffice\Contracts\Support\ModuleInterface;
use EOffice\Core\Application\ModuleTrait;

class UIModule implements ModuleInterface
{
    use ModuleTrait;

    public function getName(): string
    {
        return 'ui';
    }
}
