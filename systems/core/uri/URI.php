<?php

namespace Kd\Core\URI;

class URI
{
    public $url_controller = '';
    public $url_action = '';
    public $url_params = array();
    public $enable_query = true;

    public function __construct($enable_query= true)
    {
        $this->enable_query = $enable_query;
        $segment_args =$this->getURI();
        $this->url_controller = $segment_args[0];
        $this->url_action = $segment_args[1];

        if (isset($segment_args[2])) {
            $this->url_params = $segment_args[2];
        }
    }


    protected function getURI()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return array(
                0 => 'home',
                1 => 'index'
            );
        }

        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        if (empty($url[0])) {
            return array(
                0 => 'home',
                1 => 'index'
            );
        }

        $controller = $url[0];

        if (empty($url[1])) {
            return array(
                0 => $controller,
                1 => 'index'
            );
        }

        $query_index = strpos($url[1], '?');

        if (!$this->enable_query && !empty($query_index)){
            die("No access query");
        }

        if (empty(strpos($url[1], '?'))) {

            $action = $url[1];

            unset($url[0], $url[1]);

            return array(
                0 => $controller,
                1 => $action,
                2 => array_values($url)
            );
        }

        $action = substr($url[1], 0, strpos($url[1], '?'));

        $params = substr($url[1], strpos($url[1], '?') + 1);
        $params_parse = [];
        parse_str($params, $params_parse);

        return array(
            0 => $controller,
            1 => $action,
            2 => $params_parse
        );
    }
}