<?php
//key of router array is url and value is action in controller
$router['default_controller'] = 'home';

$router['default_action'] = 'index';

$router['home'] = array('index' => 'index',
    'send' => 'send',
    'receive' => 'receive'
);

$router['works'] = array('index' => 'index',
    'add' => 'addWork',
    'load' => 'loadData',
    'update' => 'ajaxUpdate',
    'delete' => 'deleteWork',
    'edit' => 'editWork'
);
return $router;