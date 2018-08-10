<?php

namespace Kd\Core\Router;

use KD\Core\URI\URI as URI;
use Kd\Core\Config\Config as Config;

class Router
{

    protected static $config = null;
    public $uri = null;
    public $class = '';
    public $method = 'index';

    public function __construct()
    {
        self::$config = new Config();

        self::$config->load('router');

        $this->uri = new URI(true);

        $this->load();
    }

    protected function load()
    {
        $this->class = ucfirst($this->uri->url_controller) . "_Controller";

        if (!file_exists(BASE_PATH . 'Controllers' . DIRECTORY_SEPARATOR . $this->class . '.php')) {
            die('No Controller');
        }

        /**
         *
         */
        require_once BASE_PATH . 'Controllers' . DIRECTORY_SEPARATOR . $this->class . '.php';

        if (!class_exists($this->class)) {
            die ('No found  controller');
        }

        $temp_item_router = self::$config->item($this->uri->url_controller);

        if (empty($temp_item_router)) {
            die('Not found config controller in router');
        }

        if (!isset($temp_item_router[$this->uri->url_action])) {
            die('Not found method in router');
        }

        $this->method = $temp_item_router[$this->uri->url_action];

        $controllerObject = new $this->class();

        if (!method_exists($controllerObject, $this->method)) {
            die ('No action');
        }

        if (!empty($this->uri->url_params)) {

            call_user_func_array(array($controllerObject, $this->method), $this->uri->url_params);

        } else {

            $controllerObject->{$this->method}();

        }
    }
}