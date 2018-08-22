<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/7/18
 * Time: 3:50 PM
 */

if (!function_exists("app")) {
    /**
     * @return \Kd\Core\Router\Router
     */
    function app()
    {
       return \Kd\Core\Router\Router::getInstance();
    }
}

if (!function_exists("view")) {
    /**
     * @return \Kd\Core\View\RenderView
     */
    function view()
    {
        return \Kd\Core\View\RenderView::getInstance();
    }
}