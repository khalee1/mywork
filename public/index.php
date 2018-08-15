<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/7/18
 * Time: 3:07 PM
 */

//set a root path project
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the resource project's "src" folder, like "/var/www/html/web/src".
define('BASE_PATH', ROOT . 'src' . DIRECTORY_SEPARATOR);
//set a constant that holds the system file "systems" folder , like "/var/www/html/web/systems"
define('SYS_PATH', ROOT . 'systems'. DIRECTORY_SEPARATOR);

//load file init
require_once SYS_PATH . 'common' . DIRECTORY_SEPARATOR . 'kd_init.php';
//load Router
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'router' . DIRECTORY_SEPARATOR . 'Router.php';
//load URI
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . 'URI.php';
//load Controller
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'Controller.php';
//load Config
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Config.php';
//load Config
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'verify_data' . DIRECTORY_SEPARATOR . 'Verify_Data.php';
//load Config
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'RenderView.php';
//load Config
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'entities' . DIRECTORY_SEPARATOR . 'Works.php';
//load DAO (working with DB)
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DAO' . DIRECTORY_SEPARATOR . 'Work_DAO.php';

//Init App
$app= new \Kd\Core\Router\Router();
