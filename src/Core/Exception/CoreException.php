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

namespace EOffice\Core\Exception;

use EOffice\Contracts\Support\ModuleInterface;

class CoreException extends \Exception
{
    public static function modulesFileNotFound(string $path): self
    {
        return new self(sprintf(
            'Modules config "%s" file not exists.',
            $path
        ));
    }

    public static function moduleShouldImplementModuleInterface(string $class): self
    {
        return new self(sprintf(
            'Module class "%s" should implement "'.ModuleInterface::class.'"',
            $class
        ));
    }
}
