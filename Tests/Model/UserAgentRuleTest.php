<?php

namespace Miisieq\RobotsTxtBundle\Tests\Model;

use Miisieq\RobotsTxtBundle\Model\UserAgentRule;
use PHPUnit\Framework\TestCase;

class UserAgentRuleTest extends TestCase
{
    public function testSetAndGet()
    {
        $userAgentRule = new UserAgentRule('*');
        $userAgentRule->setAllow(['/']);
        $userAgentRule->addAllow('/public');
        $userAgentRule->setDisallow(['/admin', '/login']);
        $userAgentRule->addDisallow('/logout');

        $this->assertInstanceOf('\Miisieq\RobotsTxtBundle\Model\UserAgentRule', $userAgentRule);
        $this->assertSame('*', $userAgentRule->getName());
        $this->assertSame(['/', '/public'], $userAgentRule->getAllow());
        $this->assertSame(['/admin', '/login', '/logout'], $userAgentRule->getDisallow());
    }
}
