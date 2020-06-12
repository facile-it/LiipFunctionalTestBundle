<?php

declare(strict_types=1);

namespace Facile\SymfonyFunctionalTestCase\Tests\App;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * @return Bundle[]
     */
    public function registerBundles(): array
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new AcmeBundle(),
        ];

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/config.yml');

        if (self::VERSION_ID >= 50000) {
            $loader->load(__DIR__ . '/config_5.yml');
        }
    }

    public function getCacheDir(): string
    {
        return $this->getBaseDir() . 'cache';
    }

    public function getLogDir(): string
    {
        return $this->getBaseDir() . 'log';
    }

    protected function getBaseDir(): string
    {
        return sys_get_temp_dir() . '/facile-it-testcase/' . (new \ReflectionClass($this))->getShortName() . '/var/';
    }
}
