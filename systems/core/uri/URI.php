<?php

namespace Kd\Core\URI;

class URI
{
    public $url_controller = '';
    public $url_action = '';
    public $url_params = array();
    public $enable_query = true;

    public function __construct($enable_query = true)
    {
        $this->enable_query = $enable_query;
        $segment_args = $this->getURI();
        $this->url_controller = $segment_args[0];
        $this->url_action = $segment_args[1];

        if (isset($segment_args[2])) {
            $this->url_params = $segment_args[2];
        }
    }

    public function getUrlHaveQuery($url)
    {
        $url = explode('?', $url);
        $params_parse = [];
        parse_str($url[1], $params_parse);

        $url_array = $this->getUrlHaveNoQuery($url[0]);

        if (isset($url_array[2])) {
            $url_array[2] = array_merge($url_array[2], $params_parse);
        } else {
            $url_array[2] = $params_parse;
        }

        return $url_array;
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

        $query_index = strpos($url, '?');

        if (!$this->enable_query && !empty($query_index)) {
            die("No access query");
        }

        if (empty($query_index)) {
            return $this->getUrlHaveNoQuery($url);
        }

        return $this->getUrlHaveQuery($url);
    }
}