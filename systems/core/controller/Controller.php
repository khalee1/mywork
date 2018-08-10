<?php

namespace Kd\Core\Controller;
use Kd\Core\Config\Config as Config;
use Kd\Models\DAO\Work_DAO as Works;
use PDO;

class Controller
{
    /**
     * @param DAO $model Model of Controller
     *
     * */
    public $model = null ;

    /**
     * @param database $db Database Connect
     *
     * */
    public $db = null ;

    public $config = null;

    function __construct(){
        $this->config = new Config();
        $this->config->load('config');
        $this->openConnectionToDatabase($this->config->item('db'));
        $this->model = new Works($this->db);
    }

    private function openConnectionToDatabase($configDB){
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO($configDB['type'] . ':host=' . $configDB['host'] . ';dbname=' . $configDB['schema'] . ';charset=' . $configDB['charset'], $configDB['user'], $configDB['pass'], $options);
    }
}