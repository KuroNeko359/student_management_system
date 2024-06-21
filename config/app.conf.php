<?php
return array(
    'app' => [
        'default_platform' => 'home', // 默认平台
        'admin' => 'admin',
    ],
    'home' => [
        'default_controller' => 'admin', // 默认控制器
        'default_action' => 'home', // 默认方法
    ],
    'admin' => [
        'default_controller' => 'admin', // 默认控制器
        'default_action' => 'index', // 默认方法
    ],
);