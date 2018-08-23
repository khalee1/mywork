<?php

namespace Kd\Core\Router;

use Kd\Core\Controller\Controller;
use Kd\Core\URI\URI;
use Kd\Core\Config\Config as Config;
use Exception;

class Router
{

    protected static $config = null;

    public $uri = null;

    public $class = '';

    public $method = 'index';

    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }


    public function __construct()
    {
        self::$config = new Config();
        self::$config->load('router');
        $this->uri = new URI(true);
        $this->loadRouter();
    }

    /**
     * Directional router , call the current controller corresponding to the url
     *
     * @param null
     *
     * @return void
     *
     * @throws \Exception
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    protected function loadRouter()
    {
        $this->class = ucfirst($this->uri->urlController) . "_Controller";

        if (!file_exists(BASE_PATH . 'Controllers' . DIRECTORY_SEPARATOR . $this->class . '.php')) {
            throw new Exception('No Controller');
        }

        require_once BASE_PATH . 'Controllers' . DIRECTORY_SEPARATOR . $this->class . '.php';

        if (!class_exists($this->class)) {
            throw new Exception('No found  controller');
        }

        $tmpRouterItem = self::$config->item($this->uri->urlController);

        if (empty($tmpRouterItem)) {
            throw new Exception('Not found config controller in router');
        }

        if (!isset($tmpRouterItem[$this->uri->urlAction])) {
            throw new Exception('Not found method in router');
        }

        $this->method = $tmpRouterItem[$this->uri->urlAction];

        $currentController = new $this->class();

        if (!method_exists($currentController, $this->method)) {
            throw new Exception('No action');
        }

        if (empty($this->uri->urlParams)) {
            $currentController->{$this->method}();
            return;
        }

        call_user_func_array(array($currentController, $this->method), $this->uri->urlParams);
    }
}