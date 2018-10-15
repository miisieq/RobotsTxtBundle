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

namespace Miisieq\RobotsTxtBundle\Tests\Controller;

use Miisieq\RobotsTxtBundle\Controller\RobotsController;
use Miisieq\RobotsTxtBundle\Generator\Generator;
use Symfony\Component\HttpFoundation\Response;

class RobotsControllerTest extends \PHPUnit\Framework\TestCase
{
    public function testGenerate(): void
    {
        $controller = new RobotsController(
            new Generator('http://example.com', 'dummy', [])
        );

        $response = $controller->getAction();

        $this->assertInstanceOf(Response::class, $response);
    }
}
