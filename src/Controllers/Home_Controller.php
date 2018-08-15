<?php

use Kd\Core\Controller\Controller as Controller;

class Home_Controller extends Controller
{
    public function index()
    {
        $this->view->renderView('Layouts/header');
        $this->view->renderView('home/index');
        $this->view->renderView('Layouts/footer');
    }
}
