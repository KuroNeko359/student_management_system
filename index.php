<?php

const APP_PATH = __DIR__ . '/';

require(APP_PATH . 'core/Core.php');


header("Content-type: text/html; charset=utf-8");


// 实例化并运行核心类
$core = new core\Core();
$core->run();


