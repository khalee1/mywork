<?php
$router = array(
    'default_controller' => 'home' ,
    'default_action'     => 'index',
    'home'               => array('index' => 'index'),
    'works'              => array(  'index' => 'index' ,
                                    'add'  => 'add',
                                    'load' => 'load',
                                    'update' => 'update',
                                    'delete'  =>  'delete',
                                    'edit' => 'edit')
);
return $router;