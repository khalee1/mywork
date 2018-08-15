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
        $this->loadRouter();
    }

    protected function loadRouter()
    {
        $this->class = ucfirst($this->uri->urlController) . "_Controller";

        if (!file_exists(BASE_PATH . 'Controllers' . DIRECTORY_SEPARATOR . $this->class . '.php')) {
            die('No Controller');
        }

        require_once BASE_PATH . 'Controllers' . DIRECTORY_SEPARATOR . $this->class . '.php';

        if (!class_exists($this->class)) {
            die ('No found  controller');
        }

        $tmpRouterItem = self::$config->item($this->uri->urlController);

        if (empty($tmpRouterItem)) {
            die('Not found config controller in router');
        }

        if (!isset($tmpRouterItem[$this->uri->urlAction])) {
            die('Not found method in router');
        }

        $this->method = $tmpRouterItem[$this->uri->urlAction];

        $controllerObject = new $this->class();

        if (!method_exists($controllerObject, $this->method)) {
            die ('No action');
        }

        if (empty($this->uri->urlParams)) {
            $controllerObject->{$this->method}();
            return;
        }

        call_user_func_array(array($controllerObject, $this->method), $this->uri->urlParams);
    }
}