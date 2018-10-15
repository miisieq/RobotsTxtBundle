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

namespace Miisieq\RobotsTxtBundle\Model;

class UserAgentRule
{
    protected $name;

    protected $allow = [];

    protected $disallow = [];

    /**
     * UserAgent constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAllow(): array
    {
        return $this->allow;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function addAllow(string $url): self
    {
        $this->allow[] = $url;

        return $this;
    }

    /**
     * @param array $allow
     *
     * @return $this
     */
    public function setAllow(array $allow): self
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * @return array
     */
    public function getDisallow(): array
    {
        return $this->disallow;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function addDisallow(string $url): self
    {
        $this->disallow[] = $url;

        return $this;
    }

    /**
     * @param array $disallow
     *
     * @return $this
     */
    public function setDisallow($disallow): self
    {
        $this->disallow = $disallow;

        return $this;
    }
}
