<?php

namespace MovingImage\Bundle\VM6ApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class VM6ApiExtension
 * @package VM6ApiBundle\DependencyInjection
 *
 * @author Robert Szeker <robert.szeker@movingimage.com>
 */
class VM6ApiExtension extends ConfigurableExtension
{
    /**
     * Flatten multi-dimensional Symfony configuration array into a
     * one-dimensional parameters array.
     *
     * @param ContainerBuilder $container
     * @param array            $configs
     * @param string           $root
     *
     * @return array
     */
    private function flattenParametersFromConfig(ContainerBuilder $container, $configs, $root)
    {
        $parameters = [];

        foreach ($configs as $key => $value) {
            $parameterKey = sprintf('%s_%s', $root, $key);
            if (is_array($value)) {
                $parameters = array_merge(
                    $parameters,
                    $this->flattenParametersFromConfig($container, $value, $parameterKey)
                );

                continue;
            }

            $parameters[$parameterKey] = $value;
        }

        return $parameters;
    }

    protected function loadInternal(array $configs, ContainerBuilder $container)
    {
        $parameters = $this->flattenParametersFromConfig($container, $configs, 'vm6_api');
        foreach ($parameters as $key => $value) {
            $container->setParameter($key, $value);
        }

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config/services/')
        );

        // Always load the services that will always be the same
        $loader->load('main.yml');
    }
}