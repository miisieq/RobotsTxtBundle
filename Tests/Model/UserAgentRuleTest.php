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
use PHPUnit\Framework\TestCase;

class UserAgentRuleTest extends TestCase
{
    public function testSetAndGet(): void
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
