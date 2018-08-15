<?php

namespace Kd\Core\Controller;

use Kd\Core\Config\Config as Config;
use Kd\Core\View\RenderView as RenderView;
use PDO;


class Controller
{
    public $db = null;

    public $config = null;

    public $view = null;

    function __construct()
    {
        $this->config = new Config();
        $this->config->load('config');
        $this->openConnectionToDatabase($this->config->item('db'));
        $this->view = new RenderView();
    }


    private function openConnectionToDatabase($configDB)
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->db = new PDO($configDB['type'] .
                            ':host=' . $configDB['host'] .
                            ';dbname=' . $configDB['schema'] .
                            ';charset=' . $configDB['charset'],
                            $configDB['user'],
                            $configDB['pass'],
                            $options
        );
    }

    function __destruct()
    {
       $this->view->show();
    }
}