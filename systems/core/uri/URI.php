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