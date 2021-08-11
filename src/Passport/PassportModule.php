<?php

namespace EOffice\Passport;

use EOffice\Contracts\Support\ModuleInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PassportModule implements ModuleInterface
{
    public function build(ContainerBuilder $builder): void
    {
        // TODO: Implement build() method.
    }

    public function getName(): string
    {
        return 'passport';
    }

    public function getBaseDir(): string
    {
        return realpath(__DIR__);
    }
}
