<?php

/*
 * This file is part of the `miisieq/RobotsTxtBundle` project.
 *
 * (c) https://github.com/miisieq/RobotsTxtBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miisieq\RobotsTxtBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MiisieqRobotsTxtExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $def = $container->getDefinition('miisieq_robots_txt_bundle.generator');
        $def->replaceArgument(
            0,
            $config['host']
        );
        $def->replaceArgument(
            1,
            $container->getParameter('kernel.environment') === $config['production_environment']
        );
        $def->replaceArgument(
            2,
            $config['sitemaps']
        );
    }
}
