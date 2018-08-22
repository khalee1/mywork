<?php defined('SYS_PATH') OR exit('No direct script access allowed');
/**
 * Configuration for: DB ,  .. (continue )
 * This is the place where you define your database credentials, database type etcdevelop ,v.v...
 * Exam : You want config to Database with parameter such as ( type, host , schema... )
 */
$config['db'] = array(
    'type' => 'mysql',
    'host' => 'mysql',
    'schema' => 'my_work',
    'user' => 'root',
    'pass' => 'root',
    'charset' => 'utf8',
);

/**
 * return config array and In core/config/Config.php you can get array.
 * similar router.php, ..
 * if you have any config: You can create {your_file_config}.php and load it with Config.php
 */
return $config;

