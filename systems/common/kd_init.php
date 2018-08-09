<?php defined('SYS_PATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/8/18
 * Time: 11:21 AM
 */

/**
 * Configuration for: URL
 */
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);