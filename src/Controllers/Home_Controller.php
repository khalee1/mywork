<?php

use Kd\Core\Controller\Controller as Controller;

class Home_Controller extends Controller{
    public function index(){
        require BASE_PATH . 'Views/Layouts/header.php';
        require BASE_PATH . 'Views/home/index.php';
        require BASE_PATH . 'Views/Layouts/footer.php';
    }
}
