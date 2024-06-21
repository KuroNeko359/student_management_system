<?php

namespace core;

class Core
{

    /**
     * 主程序运行函数，依次执行初始化、自动加载注册、加载配置、获取请求参数、分发请求
     *
     * @return void
     */
    public function run(): void
    {
        $this->initConst();
        $this->registerAutoLoad();
        $this->loadConfig();
        $this->getRequestParams();
        $this->dispatch();
    }


    /**
     * 初始化常量
     *
     * @return void
     */
    private function initConst(): void
    {
        define('DEFAULT_CONTROLLERS_DIRECTORY', "application\\controllers\\");
        define('BASE_CONTROLLERS_DIRECTORY', "core\\base\\");
    }


    /**
     * 注册自动加载函数
     *
     * @return void
     */
    private function registerAutoLoad(): void
    {
        spl_autoload_register(array($this, 'userAutoload'));
    }

    /**
     * 自定义的类自动加载方法
     *
     * @param string $class_name 类名
     * @return void
     */
    public function userAutoload(string $class_name): void
    {
        require_once("./core/base/Controller.php");
        require_once("{$class_name}.php");
    }

    /**
     * 获取请求参数，设置平台、控制器和方法常量
     *
     * p=平台 c=控制器 a=方法
     * @return void
     */
    private function getRequestParams(): void
    {
        // 当前平台
        define('PLATFORM', $_GET['p'] ?? $GLOBALS['config']['app']['default_platform']);
        // 当前控制器名
        define('CONTROLLER', $_GET['c'] ?? $GLOBALS['config'][PLATFORM]['default_controller']);
        // 当前方法名
        define('ACTION', $_GET['a'] ?? $GLOBALS['config'][PLATFORM]['default_action']);
    }


    /**
     * 分发请求至对应控制器和方法
     *
     * @return void
     */
    private function dispatch(): void
    {
        if ($this->getControllerName() == "Controller") {
            $controller = BASE_CONTROLLERS_DIRECTORY . $this->getControllerName();
        } else {
            $controller = DEFAULT_CONTROLLERS_DIRECTORY . $this->getControllerName();
        }

        $controller = new $controller;
        // 调用当前方法
        $action_name = $this->getActionName();
        $controller->$action_name();
    }


    /**
     * 加载配置文件
     *
     * @return void
     */
    private function loadConfig(): void
    {
        $GLOBALS['config'] = require './config/app.conf.php';
    }

    /**
     * 检查URL是否为空
     *
     * @param string $url URL字符串
     * @return bool URL是否为空
     */
    private function isUrlEmpty($url): bool
    {
        return empty($url);
    }


    /**
     * 获取完整的控制器名
     *
     * @return string 控制器名
     */
    private function getControllerName(): string
    {
        return CONTROLLER . 'Controller';
    }


    /**
     * 获取Action方法名
     *
     * @return string Action方法名
     */
    private function getActionName(): string
    {
        return ACTION . 'Action';
    }
}
