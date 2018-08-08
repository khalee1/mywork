<?php

namespace Kd\Core\Router;
use KD\Core\URI\URI as URI;

class Router
{

    protected $router = array();

    public $uri = null;
    public $class = '';

    public $method = 'index';


    public function  __construct()
    {
        $this->_set_router();

        $this->uri = new URI();
        $this->load();
    }
    protected function _set_router(){

        $this->router['default_controller'] = 'home';
        $this->router['home'] = array(
            'index' => 'index'
        );
        $this->router['works'] = array(
            'index' => 'index' ,
            'add'  => 'add',
            'load' => 'load',
            'update' => 'update',
            'delete'  =>  'delete',
            'edit' => 'edit'
        );

        /*if (file_exists(SYS_PATH . '/common/router.php')) {
            require_once SYS_PATH . '/common/router.php';
            if (isset($router) && is_array($router)) $this->router_array = $router;

        }
        else
        {
            die("No Router");
        }*/
    }
    protected function load() {

        $this->class =  ucfirst($this->uri->url_controller)."_Controller";

        if(!file_exists(BASE_PATH.'Controllers'.DIRECTORY_SEPARATOR.$this->class.'.php'))
        {
            die('No Controller');
        }


        require_once BASE_PATH.'Controllers'.DIRECTORY_SEPARATOR.$this->class.'.php';


        if (!class_exists($this->class)){
            die ('Không tìm thấy controller');
        }
        //echo $this->uri->url_action;


        if (isset($this->router[$this->uri->url_controller][$this->uri->url_action]))
        {

            $this->method = $this->router[$this->uri->url_controller][$this->uri->url_action];

        }
        else
        {
            die('Not found method in router');
        }
        $controllerObject = new $this->class();


        if ( !method_exists($controllerObject, $this->method)){
            die ('No action');
        }
        else{
            if (!empty($this->uri->url_params)) {
                // Call the method and pass arguments to it
                call_user_func_array(array($controllerObject, $this->method), $this->uri->url_params);
            } else {
                // If no parameters are given, just call the method without parameters, like $this->home->method();
                $controllerObject->{$this->method}();
            }
        }



    }





}