<?php

namespace EOffice\Contracts\Support;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface ModuleInterface
{
    public function build(ContainerBuilder $builder): void;

    public function getName(): string;

    public function getBaseDir(): string;
}
