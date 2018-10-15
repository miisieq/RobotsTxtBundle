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

namespace Miisieq\RobotsTxtBundle\Tests\Generator;

use Miisieq\RobotsTxtBundle\Generator\Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GeneratorTest extends TestCase
{
    public function testGenerateEmptyRobots(): void
    {
        $generator = new Generator(
            'http://example.com',
            'dummy',
            []
        );
        $response = $generator->generate();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('text/plain', $response->headers->get('content-type'));
    }

    /**
     * @return array
     */
    public function emptyRobotsValidDataProvider(): array
    {
        return [
            [
                'prod',
                [
                    'User-agent: *',
                    'Allow: /'
                ],
            ],
            [
                'dev',
                [
                    'User-agent: *',
                    'Disallow: /'
                ],
            ],
        ];
    }

    /**
     * @dataProvider emptyRobotsValidDataProvider
     *
     * @param string $environment
     * @param array $expected
     */
    public function testGenerateEmptyProdRobots(string $environment, array $expected): void
    {
        $generator = new Generator(
            'http://example.com',
            $environment,
            []
        );
        $response = $generator->generate();
        $responseContent = $this->trimResponseContent($response->getContent());

        $this->assertSame(implode(PHP_EOL, $expected), $responseContent);
    }

    /**
     * @return array
     */
    public function siteMapsDataProvider(): array
    {
        return [
            [
                'http://example.com',
                [
                    '/sitemap-1.xml',
                    '/sitemap-2.xml',
                ],
                [
                    'Sitemap: http://example.com/sitemap-1.xml',
                    'Sitemap: http://example.com/sitemap-2.xml',
                ],

            ]
        ];
    }

    /**
     * @dataProvider siteMapsDataProvider
     *
     * @param string $host
     * @param array $siteMaps
     * @param array $expected
     */
    public function testGenerateRobotsWithSiteMaps(string $host, array $siteMaps, array $expected): void
    {
        $generator = new Generator(
            $host,
            'dummy',
            $siteMaps
        );
        $responseContent = $this->removeEverythingExceptSiteMaps($generator->generate()->getContent());

        $this->assertSame(implode(PHP_EOL, $expected), $responseContent);
    }

    /**
     * Remove unnecessary data (comments and new lines) from response content.
     *
     * @param string $content
     * @return string
     */
    private function trimResponseContent(string $content): string
    {
        $lines = explode(PHP_EOL, $content);

        foreach ($lines as $key => $line) {
            if ('#' === substr($line, 0, 1)
                || '' === $line
            ) {
                unset($lines[$key]);
            }
        }

        return implode(PHP_EOL, $lines);
    }

    /**
     * Remove all lines except site maps definitions from response content.
     *
     * @param string $content
     * @return string
     */
    private function removeEverythingExceptSiteMaps(string $content): string
    {
        $lines = explode(PHP_EOL, $content);

        foreach ($lines as $key => $line) {
            if (0 !== strpos($line, 'Sitemap')) {
                unset($lines[$key]);
            }
        }

        return implode(PHP_EOL, $lines);
    }
}
