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

namespace Miisieq\RobotsTxtBundle\Tests\Model;

use Miisieq\RobotsTxtBundle\Model\UserAgentRule;
use Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection;
use PHPUnit\Framework\TestCase;

class UserAgentRuleCollectionTest extends TestCase
{
    public function testSetAndGet(): void
    {
        $firstRule = (new UserAgentRule('googlebot'))->addAllow('/');
        $secondRule = (new UserAgentRule('bingbot'))->addDisallow('/');

        $collection = new UserAgentRuleCollection();
        $this->assertInstanceOf('\Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection', $collection);

        $collection->setSiteMaps(['/sitemap.xml']);
        $this->assertSame(['/sitemap.xml'], $collection->getSiteMaps());

        $collection->setUserAgentRules([$firstRule]);
        $this->assertSame([$firstRule], $collection->getUserAgentRules());

        $collection->addUserAgentRules($secondRule);
        $this->assertSame([$firstRule, $secondRule], $collection->getUserAgentRules());
    }
}
