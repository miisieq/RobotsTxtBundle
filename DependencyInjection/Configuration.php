<?php

/*
 * This file is part of the `miisieq/RobotsTxtBundle` project.
 *
 * (c) https://github.com/miisieq/RobotsTxtBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Miisieq\RobotsTxtBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('miisieq_robots_txt');

        $rootNode
            ->children()
                ->scalarNode('host')
                    ->defaultValue('')
                ->end()
                ->scalarNode('production_environment')
                    ->defaultValue('prod')
                ->end()
                ->arrayNode('sitemaps')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
