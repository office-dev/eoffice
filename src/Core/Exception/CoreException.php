<?php

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
