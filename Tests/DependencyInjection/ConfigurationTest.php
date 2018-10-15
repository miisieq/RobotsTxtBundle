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

namespace Miisieq\RobotsTxtBundle\Tests\DependencyInjection;

use Miisieq\RobotsTxtBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

class ConfigurationTest extends TestCase
{
    /**
     * @return array
     */
    public function validConfigDataProvider(): array
    {
        return [
            [
                [],
                [
                    'host'     => '',
                    'sitemaps' => [],
                ],
            ],
            [
                [
                    'host'     => 'http://example.com',
                    'sitemaps' => [
                        '/sitemap-1.xml',
                        '/sitemap-2.xml',
                    ],
                ],
                [
                    'host'     => 'http://example.com',
                    'sitemaps' => [
                        '/sitemap-1.xml',
                        '/sitemap-2.xml',
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider validConfigDataProvider
     *
     * @param array $options
     * @param array $results
     */
    public function testConfigTree(array $options, array $results): void
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, [$options]);

        $this->assertEquals($results, $config);
    }
}
