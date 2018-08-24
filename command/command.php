<?php
//set a root path project

//set a root path project
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the resource project's "src" folder, like "/var/www/html/web/src".
define('BASE_PATH', ROOT . 'src' . DIRECTORY_SEPARATOR);
//set a constant that holds the system file "systems" folder , like "/var/www/html/web/systems"
define('SYS_PATH', ROOT . 'systems' . DIRECTORY_SEPARATOR);

define('KD_ENVIRONMENT', (getenv('KD_ENVIRONMENT') != null) ? getenv('KD_ENVIRONMENT') : 'development');

require_once ROOT . "vendor/autoload.php";

set_exception_handler(array("\Kd\Http\Exception\Error", "exceptionHandlerCommand"));

$app = app()->run($_SERVER["argv"][1]);


