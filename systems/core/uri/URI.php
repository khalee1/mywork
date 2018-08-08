<?php

namespace Kd\Core\URI;


class URI
{

    public $url_controller = '';

    public $url_action = '';

    public $url_params = array();


    public function __construct()
    {
        $this->getURI();
    }

    function removeQuery($url)
    {
        $url_ac = "";
        if (strpos($url, '?')>=0)
        {
            $url_ac = substr($url, 0,strpos($url, '?') );
        }
        $parsed = [];
        parse_str(substr($url, strpos($url, '?') + 1), $parsed);

    }
    protected function getURI() {

        if (! isset($_SERVER['REQUEST_URI']))
        {
            return;
        }

        $url = trim($_SERVER['REQUEST_URI'], '/');

        $url = filter_var($url, FILTER_SANITIZE_URL);

        $url = explode('/', $url);


        if(!isset($url[0]))
        {
            $this->url_controller = 'home' ;
        }
        else
        {
            $this->url_controller = $url[0];
            if (!isset($url[1])){
                $this->url_action = 'index';
            }
            else{

                if (!empty(strpos($url[1], '?')))
                {
                    $this->url_action = substr($url[1], 0,strpos($url[1], '?') );
                    $params = substr($url[1], strpos($url[1], '?') + 1);
                    parse_str($params, $this->url_params);
                } else{
                    $this->url_action = $url[1];
                    unset($url[0],$url[1]);
                    $this->url_params = array_values($url);
                }



            }

        }


    }


}