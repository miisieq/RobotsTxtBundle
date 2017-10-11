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

use Miisieq\RobotsTxtBundle\Generator\Generator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class RobotsController extends Controller
{
    /**
     * Return robots.txt file.
     *
     * @Route("/robots.txt")
     *
     * @return Response
     */
    public function getAction()
    {
        return $this->get(Generator::class)->generate();
    }
}
