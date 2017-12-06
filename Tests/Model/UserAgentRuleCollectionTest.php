<?php

namespace Miisieq\RobotsTxtBundle\Tests\Model;

use Miisieq\RobotsTxtBundle\Model\UserAgentRule;
use Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection;
use PHPUnit\Framework\TestCase;

class UserAgentRuleCollectionTest extends TestCase
{
    public function testSetAndGet()
    {
        $firstRule = (new UserAgentRule('googlebot'))->addAllow('/');
        $secondRule = (new UserAgentRule('bingbot'))->addDisallow('/');

        $collection = new UserAgentRuleCollection();
        $this->assertInstanceOf('\Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection', $collection);

        $collection->setSitemaps(['/sitemap.xml']);
        $this->assertSame(['/sitemap.xml'], $collection->getSitemaps());

        $collection->setUserAgentRules([$firstRule]);
        $this->assertSame([$firstRule], $collection->getUserAgentRules());

        $collection->addUserAgentRules($secondRule);
        $this->assertSame([$firstRule, $secondRule], $collection->getUserAgentRules());
    }
}
