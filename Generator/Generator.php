<?php

namespace Miisieq\RobotsTxtBundle\Generator;

use Miisieq\RobotsTxtBundle\Model\UserAgentRule;
use Miisieq\RobotsTxtBundle\Model\UserAgentRuleCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class Generator implements GeneratorInterface
{
    const COMMENT = "# www.robotstxt.org/\n# www.google.com/support/webmasters/bin/answer.py?hl=en&answer=156449\n";

    /**
     * @var string
     */
    protected $environment;

    /**
     * @var array
     */
    protected $sitemaps;

    /**
     * @var UserAgentRuleCollection
     */
    protected $collection;

    /**
     * @var Request|null
     */
    protected $request;

    /**
     * Generator constructor.
     *
     * @param RequestStack $request
     * @param $environment
     * @param array $sitemaps
     */
    public function __construct(RequestStack $request, $environment, array $sitemaps)
    {
        $this->request = $request->getMasterRequest();
        $this->environment = $environment;
        $this->collection = new UserAgentRuleCollection([], $sitemaps);
    }

    /**
     * {@inheritdoc}
     *
     * @return Response
     */
    public function generate()
    {
        $this->initializeEnvironmentDependent();

        $content = self::COMMENT;

        foreach ($this->collection->getUserAgentRules() as $userAgentRule) {
            $content .= PHP_EOL.'User-agent: '.$userAgentRule->getName().PHP_EOL;

            foreach ($userAgentRule->getDisallow() as $disallow) {
                $content .= 'Disallow: '.$disallow.PHP_EOL;
            }

            foreach ($userAgentRule->getAllow() as $allow) {
                $content .= 'Allow: '.$allow.PHP_EOL;
            }
        }

        if ($this->request instanceof Request) {
            foreach ($this->collection->getSitemaps() as $sitemap) {
                $content .= PHP_EOL.'Sitemap: '.$this->request->getSchemeAndHttpHost().$this->request->getBasePath().$sitemap;
            }
        }

        return new Response($content, Response::HTTP_OK, ['Content-Type' => 'text/plain']);
    }

    /**
     * Add default rules environment-dependant.
     */
    protected function initializeEnvironmentDependent()
    {
        if ('prod' === $this->environment) {
            $this->collection->addUserAgentRules((new UserAgentRule('*'))->setAllow(['/']));
        } else {
            $this->collection->addUserAgentRules((new UserAgentRule('*'))->setDisallow(['/']));
        }
    }
}
