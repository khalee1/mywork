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
define('SYS_PATH', ROOT . 'systems' . DIRECTORY_SEPARATOR);

define('KD_ENVIRONMENT', (getenv('KD_ENVIRONMENT') != null) ? getenv('KD_ENVIRONMENT') : 'development');

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
//load verify
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'verify' . DIRECTORY_SEPARATOR . 'ValidateDataForm.php';
//load verify exception
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'verify' . DIRECTORY_SEPARATOR . 'PostException.php';
//load view
require_once SYS_PATH . 'core' . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR . 'RenderView.php';
//load DTO
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DTO' . DIRECTORY_SEPARATOR . 'Works.php';
//load DTO
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DTO' . DIRECTORY_SEPARATOR . 'Status.php';
//load DAO (working with DB)
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DAO' . DIRECTORY_SEPARATOR . 'Model_DAO.php';
//load DAO (working with DB)
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DAO' . DIRECTORY_SEPARATOR . 'Work_DAO.php';
//load DAO (working with DB)
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DAO' . DIRECTORY_SEPARATOR . 'Status_DAO.php';
//load DAO (working with DB)
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'DAO' . DIRECTORY_SEPARATOR . 'Database.php';
//load BLO
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'BLO' . DIRECTORY_SEPARATOR . 'Work_BLO.php';
//load BLO
require_once SYS_PATH . 'models' . DIRECTORY_SEPARATOR . 'BLO' . DIRECTORY_SEPARATOR . 'Status_BLO.php';
//load helper
require_once SYS_PATH . 'libraries' . DIRECTORY_SEPARATOR . 'helpers.php';
//load Error
require_once SYS_PATH . 'http' . DIRECTORY_SEPARATOR . 'exception' . DIRECTORY_SEPARATOR . 'Error.php';

set_exception_handler(array("\Kd\Http\Exception\Error", "exceptionHandler"));

if (KD_ENVIRONMENT !== 'test') $app = app();
