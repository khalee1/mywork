<?php

use Kd\Core\Controller\Controller as Controller;

class Home_Controller extends Controller
{
    /**
     * Render view home page
     *
     * @param  null
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     *
     */
    public function index()
    {
        $this->view->renderView('Layouts/header');
        $this->view->renderView('home/index');
        $this->view->renderView('Layouts/footer');
    }
}
