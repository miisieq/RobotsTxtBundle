<?php

/*
 * This file is part of the `miisieq/RobotsTxtBundle` project.
 *
 * (c) https://github.com/miisieq/RobotsTxtBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miisieq\RobotsTxtBundle\Controller;

use Miisieq\RobotsTxtBundle\Generator\GeneratorInterface;
use Symfony\Component\HttpFoundation\Response;

class RobotsController
{
    /**
     * @var GeneratorInterface
     */
    private $generator;

    /**
     * RobotsController constructor.
     * @param GeneratorInterface $generator
     */
    public function __construct(GeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Return robots.txt file.
     *
     * @return Response
     */
    public function getAction()
    {
        return $this->generator->generate();
    }
}
