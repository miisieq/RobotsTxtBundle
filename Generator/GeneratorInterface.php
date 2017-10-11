<?php

/*
 * This file is part of the `miisieq/RobotsTxtBundle` project.
 *
 * (c) https://github.com/miisieq/RobotsTxtBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miisieq\RobotsTxtBundle\Generator;

use Symfony\Component\HttpFoundation\Response;

interface GeneratorInterface
{
    /**
     * Generate a robots.txt file.
     *
     * @return Response
     */
    public function generate();
}
