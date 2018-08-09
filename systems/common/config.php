<?php defined('SYS_PATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/7/18
 * Time: 3:58 PM
 */

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
$config['db'] = array(
    'type' => 'mysql',
    'host' => 'mysql',
    'schema'=>'my_work',
    'user' => 'root',
    'pass' => 'root' ,
    'charset'=> 'utf8',
    );

return $config;

