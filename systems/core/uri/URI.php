<?php

namespace Kd\Core\URI;

class URI
{
    public $urlController = '';

    public $urlAction = '';

    public $urlParams = array();

    public $enableQuery = true;

    public function __construct($enableQuery = true)
    {
        $this->enableQuery = $enableQuery;
        $segmentArgs = $this->getURI();
        $this->urlController = $segmentArgs[0];
        $this->urlAction = $segmentArgs[1];

        if (isset($segmentArgs[2])) {
            $this->urlParams = $segmentArgs[2];
        }
    }

    /**
     * Split Url to Controller, Action , Param with url has a format( have ?):
     * Ex: localhost:8080/controller/action?id=2
     *
     * @param string $url
     *
     * @return array : Contains controller , Action, Params
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function getUrlHaveQuery($url)
    {
        $url = explode('?', $url);
        $paramsParse = [];
        parse_str($url[1], $paramsParse);

        $urlArray = $this->getUrlHaveNoQuery($url[0]);

        if (isset($urlArray[2])) {
            $urlArray[2] = array_merge($urlArray[2], $paramsParse);
        } else {
            $urlArray[2] = $paramsParse;
        }

        return $urlArray;
    }

    /**
     * Split Url to Controller, Action , Param without Query (Haven't ?):
     * Ex: localhost:8080/controller/action/23
     *
     * @param string $url
     *
     * @return array : Contains controller , Action, Params
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function getUrlHaveNoQuery($url)
    {
        $url = explode('/', $url);
        $controller = $url[0];

        if (empty($url[1])) {
            return array(
                0 => $controller,
                1 => 'index'
            );
        }

        $action = $url[1];
        unset($url[0], $url[1]);

        return array(
            0 => $controller,
            1 => $action,
            2 => array_values($url)
        );
    }

    /**
     * Get Url by transfer user
     *
     * @param null
     *
     * @return array : Contains controller , Action, Params
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    protected function getURI()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (empty($url)) {
            return array(
                0 => 'home',
                1 => 'index'
            );
        }

        $queryIndex = strpos($url, '?');

        if (!$this->enableQuery && !empty($queryIndex)) {
            die("No access query");
        }

        if (empty($queryIndex)) {
            return $this->getUrlHaveNoQuery($url);
        }

        return $this->getUrlHaveQuery($url);
    }
}