<?php

namespace Miisieq\RobotsTxtBundle\Model;

/**
 * Class UserAgentRuleCollection
 *
 * Example usage:
    $collection = (new UserAgentRuleCollection())
        ->setUserAgentRules([
            (new UserAgentRule('*'))
                ->setAllow(['/'])
                ->setDisallow(['/backend', '/login']),
            (new UserAgentRule('Googlebot'))
                ->setDisallow(['//*.gif$']),
        ])
    ;
 *
 *
 * @package Miisieq\RobotsTxtBundle\Model
 */
class UserAgentRuleCollection
{
    /**
     * @var UserAgentRule[]
     */
    protected $userAgentRules = [];

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
     * @return $this
     */
    public function setUserAgentRules($userAgentRules)
    {
        $this->userAgentRules = $userAgentRules;

        return $this;
    }
}
