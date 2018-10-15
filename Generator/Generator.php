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

namespace Miisieq\RobotsTxtBundle\Generator;

use Miisieq\RobotsTxtBundle\Model\UserAgentRule;
use Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection;
use Symfony\Component\HttpFoundation\Response;

class Generator implements GeneratorInterface
{
    const COMMENT = "# www.robotstxt.org/\n# www.google.com/support/webmasters/bin/answer.py?hl=en&answer=156449\n";

    /**
     * @var string
     */
    protected $host;

    /**
     * @var bool
     */
    protected $isProduction;

    /**
     * @var UserAgentRuleCollection
     */
    protected $collection;

    /**
     * Generator constructor.
     *
     * @param string $host
     * @param bool $isProduction
     * @param array  $siteMaps
     */
    public function __construct(string $host, bool $isProduction, array $siteMaps)
    {
        $this->host = $host;
        $this->isProduction = $isProduction;
        $this->collection = new UserAgentRuleCollection([], $siteMaps);
    }

    /**
     * {@inheritdoc}
     *
     * @return Response
     */
    public function generate(): Response
    {
        $this->addDefaultRules();

        $content = self::COMMENT;

        foreach ($this->collection->getUserAgentRules() as $userAgentRule) {
            $content .= PHP_EOL . 'User-agent: ' . $userAgentRule->getName() . PHP_EOL;

            foreach ($userAgentRule->getDisallow() as $disallow) {
                $content .= 'Disallow: ' . $disallow . PHP_EOL;
            }

            foreach ($userAgentRule->getAllow() as $allow) {
                $content .= 'Allow: ' . $allow . PHP_EOL;
            }
        }

        foreach ($this->collection->getSiteMaps() as $sitemap) {
            $content .= PHP_EOL . 'Sitemap: ' . $this->host . $sitemap;
        }

        return new Response($content, Response::HTTP_OK, ['Content-Type' => 'text/plain']);
    }

    /**
     * Add default rules environment-dependant.
     */
    protected function addDefaultRules()
    {
        if ($this->isProduction) {
            $this->collection->addUserAgentRules((new UserAgentRule('*'))->setAllow(['/']));
        } else {
            $this->collection->addUserAgentRules((new UserAgentRule('*'))->setDisallow(['/']));
        }
    }
}
