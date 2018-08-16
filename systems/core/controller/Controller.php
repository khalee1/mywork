<?php

namespace Kd\Core\Controller;


use Kd\Core\View\RenderView as RenderView;


class Controller
{

    public $view = null;

    function __construct()
    {

        $this->view = new RenderView();
    }

    function __destruct()
    {
        $this->view->show();
    }
}