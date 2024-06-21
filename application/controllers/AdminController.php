<?php

namespace application\controllers;

use application\models\AdminModel;
use application\models\StudentModel;
use core\base\Controller;
use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;

class AdminController extends Controller
{
    /**
     * AdminController 构造函数
     * 初始化控制器并检查用户是否为管理员。
     */
    public function __construct()
    {
        parent::__construct();
        if (ACTION == "handleLogin" || ACTION == "login") {
            return;
        }
        if (!($_SESSION['identify'] == 'admin')) {
            $this->jump('index.php?c=admin&a=login');
        }
    }

    /**
     * 处理管理员登录操作。
     * 验证登录凭据并为管理员启动会话。
     * @return void
     */
    #[NoReturn] public function handleLoginAction(): void
    {
        echo "test";
        // 判断如果请求方法不是POST则结束
        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
            die('Bad request');
        }
        if (empty($_POST)) {
            die('用户名和密码不能为空');
        }
        // 实例化admin模型
        $adminModel = new AdminModel();
        // 调用验证方法如果失败则结束
        if (!$adminModel->checkByLogin()) {
            die('登录失败，用户名或密码错误。');
        }
        // 登录成功
        session_start();
        $_SESSION['identify'] = 'admin';
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['nickname'] = $adminModel->getUserNickname();
        echo $_SESSION['nickname'];
        // 跳转到主页
        $this->jump("index.php?c=admin&a=home");
    }

    /**
     * 处理管理员更改密码操作。
     * 检查输入并更新密码。
     * @return void
     */
    public function handleChangePasswordAction(): void
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            die("账号密码不能为空");
        }
        if (!($_POST['newPassword'] == $_POST['confirmNewPassword'])) {
            die("输入的两次新密码不一致");
        }
        if (!(new AdminModel())->checkByLogin()) {
            die("密码错误，请检查您的密码");
        }
        $this->changePassword();
    }

    /**
     * 显示更改密码页面。
     * @return void
     */
    public function changePasswordAction(): void
    {
        include 'application/views/admin/admin_change_password.php';
    }

    /**
     * 默认操作，显示indexAction内容。
     * @return void
     */
    public function indexAction(): void
    {
        echo "indexAction";
    }

    /**
     * 测试操作。
     * @return void
     */
    public function testAction(): void
    {
    }

    /**
     * 显示管理员主页。
     * @return void
     */
    public function homeAction(): void
    {
        $greeting = $this->getGreeting();
        include "application/views/admin/admin_home.php";
    }

    /**
     * 显示管理员信息页面。
     * @return void
     */
    public function infoAction(): void
    {
        include "application/views/admin/admin_info.php";
    }

    /**
     * 更改管理员密码并清理会话。
     * @return void
     */
    private function changePassword(): void
    {
        $adminModel = new AdminModel();
        $adminModel->updatePassword();
        session_unset();
        include 'application/views/public/login.php';
    }
}
