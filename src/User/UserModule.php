<?php

namespace EOffice\User;

use EOffice\Contracts\Support\ModuleInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

class UserModule implements ModuleInterface
{
    public function build(ContainerBuilder $builder): void
    {
    }

    public function getName(): string
    {
        return 'user';
    }

    public function getBaseDir(): string
    {
        return realpath(__DIR__);
    }
}
