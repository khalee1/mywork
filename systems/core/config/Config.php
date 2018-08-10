<?php
namespace Kd\Core\Config;


class Config
{
    protected $config = array();

    public function load($config_name){
        if (!file_exists(SYS_PATH . '/common/'.$config_name. '.php')) {
            return FALSE;
        }
        $config_array = require_once SYS_PATH . '/common/'.$config_name . '.php';
        if (empty($config_array) || !is_array($config_array)){
            return FALSE;
        }
        foreach ($config_array as $key => $item){
            $this->config[$key] = $item;
        }
        return true;
    }

    public function item($key, $defailt_val = null){
        return isset($this->config[$key]) ? $this->config[$key] : $defailt_val;
    }

    public function set_item($key, $val){
        $this->config[$key] = $val;
    }

    public function get_config(){
        $this->config();
    }
}