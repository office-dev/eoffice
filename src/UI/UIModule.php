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
