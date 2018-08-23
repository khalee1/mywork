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

require_once ROOT . "vendor/autoload.php";

set_exception_handler(array("\Kd\Http\Exception\Error", "exceptionHandler"));

if (KD_ENVIRONMENT !== 'test') $app = app();
