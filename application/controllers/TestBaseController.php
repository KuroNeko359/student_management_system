<?php

namespace application\controllers;

use core\base\Controller;

/**
 * TestBaseController 类
 * 一个用于测试的基本控制器。
 */
class TestBaseController extends Controller {

    /**
     * 测试方法
     * 打印测试信息。
     * @return void
     */
    public function testAction(): void
    {
        echo "TestBaseController -> testAction";
    }

}
