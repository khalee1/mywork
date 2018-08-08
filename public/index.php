<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/7/18
 * Time: 3:07 PM
 */
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);


// set a constant that holds the resource project's "src" folder, like "/var/www/html/web/src".
define('BASE_PATH', ROOT . 'src' . DIRECTORY_SEPARATOR);

//set a constant that holds the system file "systems" folder , like "/var/www/html/web/systems"
define('SYS_PATH', ROOT . 'systems'. DIRECTORY_SEPARATOR);


require_once SYS_PATH . 'common' . DIRECTORY_SEPARATOR . 'kd_init.php';

require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'router' . DIRECTORY_SEPARATOR . 'Router.php';

require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'uri' . DIRECTORY_SEPARATOR . 'URI.php';

require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'Controller.php';

require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'Config.php';

require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DAO' . DIRECTORY_SEPARATOR . 'Work_DAO.php';

$app= new \Kd\Core\Router\Router();
