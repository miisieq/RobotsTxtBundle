<?php

/*
 * This file is part of the `miisieq/RobotsTxtBundle` project.
 *
 * (c) https://github.com/miisieq/RobotsTxtBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    protected $sitemaps = [];

    /**
     * UserAgentRuleCollection constructor
     *
     * @param UserAgentRule[] $userAgentRules
     * @param array $sitemaps
     */
    public function __construct(array $userAgentRules = [], array $sitemaps = [])
    {
        $this->userAgentRules = $userAgentRules;
        $this->sitemaps = $sitemaps;
    }

    /**
     * @param UserAgentRule $userAgentRule
     *
     * @return $this
     */
    public function addUserAgentRules(UserAgentRule $userAgentRule)
    {
        $this->userAgentRules[] = $userAgentRule;

        return $this;
    }

    /**
     * @return UserAgentRule[]
     */
    public function getUserAgentRules()
    {
        return $this->userAgentRules;
    }

    /**
     * @param UserAgentRule[] $userAgentRules
     *
     * @return $this
     */
    public function setUserAgentRules($userAgentRules)
    {
        $this->userAgentRules = $userAgentRules;

        return $this;
    }

    /**
     * @return array
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }

    /**
     * @param array $sitemaps
     *
     * @return $this
     */
    public function setSitemaps($sitemaps)
    {
        $this->sitemaps = $sitemaps;

        return $this;
    }
}
