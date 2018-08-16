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
        if (!file_exists(SYS_PATH . '/common/' . $configName . '.php')) {
            return FALSE;
        }

        $configArray = require_once SYS_PATH . '/common/' . $configName . '.php';

        if (empty($configArray) || !is_array($configArray)) {
            return FALSE;
        }

        foreach ($configArray as $key => $item) {
            $this->config[$key] = $item;
        }

        return true;
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