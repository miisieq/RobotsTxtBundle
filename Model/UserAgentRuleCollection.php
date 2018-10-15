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

class UserAgentRuleCollection
{
    /**
     * @var UserAgentRule[]
     */
    protected $userAgentRules = [];

    /**
     * @var array
     */
    protected $siteMaps = [];

    /**
     * UserAgentRuleCollection constructor.
     *
     * @param UserAgentRule[] $userAgentRules
     * @param array           $siteMaps
     */
    public function __construct(array $userAgentRules = [], array $siteMaps = [])
    {
        $this->userAgentRules = $userAgentRules;
        $this->siteMaps = $siteMaps;
    }

    /**
     * @param UserAgentRule $userAgentRule
     *
     * @return $this
     */
    public function addUserAgentRules(UserAgentRule $userAgentRule): self
    {
        $this->userAgentRules[] = $userAgentRule;

        return $this;
    }

    /**
     * @return UserAgentRule[]
     */
    public function getUserAgentRules(): array
    {
        return $this->userAgentRules;
    }

    /**
     * @param UserAgentRule[] $userAgentRules
     *
     * @return $this
     */
    public function setUserAgentRules($userAgentRules): self
    {
        $this->userAgentRules = $userAgentRules;

        return $this;
    }

    /**
     * @return array
     */
    public function getSiteMaps(): array
    {
        return $this->siteMaps;
    }

    /**
     * @param array $siteMaps
     *
     * @return $this
     */
    public function setSiteMaps($siteMaps): self
    {
        $this->siteMaps = $siteMaps;

        return $this;
    }
}
