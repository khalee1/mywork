<?php

namespace Kd\Core\Config;


class Config
{

    protected $config = array();

    public function set_item($key, $val)
    {
        $this->config[$key] = $val;
    }

    public function get_config()
    {
        $this->config();
    }

    /**
     * Load config for controller
     *
     * @param string $configName
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function load($configName)
    {
        $fileList = array(
            SYS_PATH . 'common/' . $configName . '.php',
            SYS_PATH . 'common/' . KD_ENVIRONMENT . DIRECTORY_SEPARATOR . $configName . '.php'
        );

        foreach ($fileList as $file){
            if (file_exists($file)) {
                $configArray = require_once $file;
            }

            if (empty($configArray) || !is_array($configArray)) {
                continue;
            }

            foreach ($configArray as $key => $item) {
                $this->config[$key] = $item;
            }
        }
    }

    /**
     * Get item config
     *
     * @param string $key
     *
     * @param  array $defaultVal
     *
     * @return boolean
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function item($key, $defaultVal = null)
    {
        return isset($this->config[$key]) ? $this->config[$key] : $defaultVal;
    }
}