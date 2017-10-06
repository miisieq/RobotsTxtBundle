<?php

namespace Miisieq\RobotsTxtBundle\Controller;

use Miisieq\RobotsTxtBundle\Model\UserAgentRule;
use Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class RobotsController extends Controller
{
    const COMMENT = "# www.robotstxt.org/\n# www.google.com/support/webmasters/bin/answer.py?hl=en&answer=156449\n";

    /**
     * Return robots.txt file.
     *
     * @Route("/robots.txt")
     *
     * @return Response
     */
    public function getAction()
    {
        $collection = new UserAgentRuleCollection();

        if ('prod' === $this->getParameter('kernel.environment')) {
            $collection->addUserAgentRules((new UserAgentRule('*'))->setAllow(['/']));
        } else {
            $collection->addUserAgentRules((new UserAgentRule('*'))->setDisallow(['/']));
        }

        $content = self::COMMENT;

        foreach ($collection->getUserAgentRules() as $userAgentRule) {
            $content .= PHP_EOL.'User-agent: '.$userAgentRule->getName().PHP_EOL;

            foreach ($userAgentRule->getDisallow() as $disallow) {
                $content .= 'Disallow: '.$disallow.PHP_EOL;
            }

            foreach ($userAgentRule->getAllow() as $allow) {
                $content .= 'Allow: '.$allow.PHP_EOL;
            }
        }

        return new Response($content, Response::HTTP_OK, ['Content-Type' => 'text/plain']);
    }
}
