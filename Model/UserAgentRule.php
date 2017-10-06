<?php

namespace Miisieq\RobotsTxtBundle\Model;

class UserAgentRule
{
    protected $name;

    protected $allow = [];

    protected $disallow = [];

    /**
     * UserAgent constructor
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * @param $url
     * @return $this
     */
    public function addAllow($url)
    {
        $this->allow[] = $url;

        return $this;
    }

    /**
     * @param array $allow
     * @return $this
     */
    public function setAllow($allow)
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * @return array
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * @param $url
     * @return $this
     */
    public function addDisallow($url)
    {
        $this->disallow[] = $url;

        return $this;
    }

    /**
     * @param array $disallow
     * @return $this
     */
    public function setDisallow($disallow)
    {
        $this->disallow = $disallow;

        return $this;
    }
}
