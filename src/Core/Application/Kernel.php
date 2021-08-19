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

namespace EOffice\Core\Application;

use EOffice\Contracts\Support\ModuleInterface;
use EOffice\Core\Exception\CoreException;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @var array<array-key,ModuleInterface>
     */
    private array $modules;

    /**
     * @return array<array-key,ModuleInterface>
     */
    public function getModules(): array
    {
        return $this->modules;
    }

    /**
     * @throws CoreException
     */
    protected function initializeBundles(): void
    {
        parent::initializeBundles();
        $this->modules = [];

        foreach ($this->initializeModules() as $module) {
            if ( ! $module instanceof ModuleInterface) {
                $moduleClass = \get_class($module);
                throw CoreException::moduleShouldImplementModuleInterface($moduleClass);
            }
            $this->modules[$module->getName()] = $module;
        }
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $env        = $this->getEnvironment();
        $projectDir = $this->getProjectDir();

        $container->import($projectDir.'/config/{packages}/*.yaml');
        $container->import($projectDir.'/config/{packages}/'.$env.'/*.yaml');

        if (is_file($projectDir.'/config/services.yaml')) {
            $container->import($projectDir.'/config/services.yaml');
            $container->import($projectDir.'/config/{services}_'.$env.'.yaml');
        } else {
            $container->import($projectDir.'/config/{services}.php');
        }

        foreach ($this->modules as $module) {
            $this->configureModule($container, $module);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $env        = $this->getEnvironment();
        $projectDir = $this->getProjectDir();
        $routes->import($projectDir.'/config/{routes}/'.$env.'/*.yaml');
        $routes->import($projectDir.'/config/{routes}/*.yaml');

        if (is_file($projectDir.'/config/routes.yaml')) {
            $routes->import($projectDir.'/config/routes.yaml');
        } else {
            $routes->import($projectDir.'/config/{routes}.php');
        }

        foreach ($this->getModules() as $module) {
            $baseDir = $module->getBaseDir();
            if (is_file($file = $baseDir.'/Resources/config/routes.yaml')) {
                $routes->import($file);
            }
        }
    }

    /**
     * @throws CoreException
     *
     * @return iterable
     */
    protected function initializeModules(): iterable
    {
        $path = $this->getProjectDir().'/config/modules.php';
        if ( ! is_file($path)) {
            throw CoreException::modulesFileNotFound($path);
        }

        /** @var array $modules */
        $modules = require $path;
        foreach ($modules as $class) {
            yield new $class();
        }
    }

    protected function configureModule(ContainerConfigurator $container, ModuleInterface $module): void
    {
        $env       = $this->getEnvironment();
        $moduleDir = $module->getBaseDir();
        $name      = $module->getName();

        $container->parameters()->set('eoffice.'.$name.'.module_dir', $moduleDir);
        if (is_file($serviceConfig = $moduleDir.'/Resources/config/services.xml')) {
            $container->import($serviceConfig);
        }
        if (is_file($envConfig = $moduleDir.'/Resources/config/{services}_'.$env.'.yaml')) {
            $container->import($envConfig);
        }
        $resourcesDir = $moduleDir.'/Resources';
        if (is_dir($resourcesDir)) {
            // load override package
            $container->import($resourcesDir.'/{packages}/*.yaml');
            $container->import($resourcesDir.'/{packages}/*.xml');
            $container->import($resourcesDir.'/{packages}/'.$env.'/*.yaml');
            $container->import($resourcesDir.'/{packages}/'.$env.'/*.xml');

            // load services
            $container->import($resourcesDir.'/{services}/*.yaml');
            $container->import($resourcesDir.'/{services}/*.xml');
            $container->import($resourcesDir.'/{services}/'.$env.'/*.yaml');
            $container->import($resourcesDir.'/{services}/'.$env.'/*.xml');
        }
    }
}
