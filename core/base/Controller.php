<?php

namespace core\base;

use JetBrains\PhpStorm\NoReturn;

/**
 * Controller 基类
 * 提供基本的控制器功能，包括验证登录、页面跳转和通用方法。
 */
class Controller
{
    /**
     * 构造方法
     * 初始化控制器并检查用户是否登录。
     */
    public function __construct()
    {
        $this->checkLogin();
    }

    /**
     * 验证当前用户是否登录
     * 如果用户未登录，跳转到登录页面。
     */
    private function checkLogin(): void
    {
        // handleLogin方法不需要验证
        if (ACTION == 'handleLogin') {
            return;
        }
        // 通过SESSION判断是否登录
        session_start();
        if (!isset($_SESSION['identify'])) {
            // 未登录跳转到登录页面
            $this->jump("/application/views/public/login.php");
        }
    }

    /**
     * 判断当前用户是否为管理员
     * 如果是返回true
     *
     * @return bool
     */
    public function isAdmin():bool
    {
        if ($_SESSION['identify'] == 'admin') {
            return true;
        }
        return false;
    }
    /**
     * 示例动作方法
     * 打印问候语。
     */
    public function helloAction(): void
    {
        echo "Hello! This is hello action from class 'Controller'";
    }

    /**
     * 跳转方法
     * 根据给定的URL进行页面跳转。
     * @param string $url 要跳转的URL
     */
    #[NoReturn] protected function jump($url): void
    {
        header("Location: $url");
        die;
    }

    /**
     * 注销登录
     * 清除会话并跳转到首页。
     */
    #[NoReturn] public function logoutAction(): void
    {
        session_unset();
        $this->jump("index.php");
    }

    /**
     * 登录动作
     * 跳转到登录页面。
     */
    #[NoReturn] public function loginAction(): void
    {
        $this->jump("/application/views/public/login.php");
    }

    /**
     * 获取问候语
     * 根据当前时间返回相应的问候语。
     * @return string 问候语
     */
    public function getGreeting(): string
    {
        date_default_timezone_set('Asia/Shanghai');
        $greeting = "你好";
        $hour = (int)date("H");  // 将小时转换为整数

        if ($hour >= 0 && $hour < 6) {
            $greeting = "凌晨了，早点睡觉!";
        } elseif ($hour >= 6 && $hour < 12) {
            $greeting = "早上好!";
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = "下午好!";
        } elseif ($hour >= 18 && $hour < 24) {
            $greeting = "晚上好!";
        }
        return $greeting;
    }
}
