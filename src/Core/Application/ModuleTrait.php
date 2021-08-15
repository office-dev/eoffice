<?php

namespace EOffice\Core\Application;

use Doctrine\Inflector\Rules\English\InflectorFactory;

trait ModuleTrait
{
    protected ?string $baseDir = null;
    protected ?string $moduleName = null;

    public function getBaseDir(): string
    {
        if(null === $this->baseDir){
            $this->buildInfo();

        }
        return $this->baseDir;
    }

    public function getName(): string
    {
        if(null === $this->moduleName){
            $this->buildInfo();
        }

        return $this->moduleName;
    }

    protected function buildInfo()
    {
        $r = new \ReflectionClass($this);

        // build className
        $class = str_replace($r->getNamespaceName()."\\", "", $r->getName());
        $class = str_replace("Module", "", $class);
        $inflector = (new InflectorFactory())->build();
        $name = $inflector->tableize($class);
        $this->moduleName = $name;

        // base dir
        $this->baseDir = dirname($r->getFileName());
    }
}
