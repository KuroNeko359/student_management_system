<?php

namespace application\controllers;

use application\models\AdminModel;
use application\models\StudentModel;
use core\base\Controller;

use JetBrains\PhpStorm\NoReturn;
use PDO;

class StudentController extends Controller {

    /**
     * StudentController 构造函数
     * 初始化控制器并检查用户是否为学生或管理员。
     */
    public function __construct()
    {
        parent::__construct();
        if (ACTION == "handleLogin" || ACTION == "login"){
            return;
        }
        if (!($_SESSION['identify'] == 'user' || $_SESSION['identify'] == 'admin')) {
            $this->jump('index.php?c=student&a=login');
        }
    }

    /**
     * 打印欢迎信息。
     * @return void
     */
    public function helloAction(): void
    {
        echo "Hello! This is StudentController";
    }

    /**
     * 显示插入学生信息的页面。
     * @return void
     */
    public function insertAction():void
    {

        if ($this->isAdmin()){
            include "application/views/user/student_insert.php";
        }else {
            $this->jump("index.php?c=admin&a=login");
        }
    }

    /**
     * 处理插入学生信息操作。
     * @return void
     */
    public function handleInsertAction():void
    {
        (new StudentModel())->insertStudent();
        $this->jump("/index.php?c=student&a=list");
    }

    /**
     * 显示编辑学生信息的页面。
     * @return void
     */
    public function editAction(): void
    {
        if ($this->isAdmin()){
            include "application/views/admin/student_edit.php";
        }else {
            $this->jump("index.php?c=admin&a=login");
        }

    }

    /**
     * 显示学生详细信息页面。
     * @return void
     */
    public function detailAction():void
    {
        include "application/views/admin/admin_student_detail.php";
    }

    /**
     * 处理更新学生信息操作。
     * @return void
     */
    #[NoReturn] public function updateAction(): void
    {
        $studentModel = new StudentModel();
        $studentId = $_POST['studentId'];

        $dataMap = [
            ":studentNumber" => $_POST['studentNumber'],
            ":studentName" => $_POST['studentName'],
            ":gender" => $_POST['gender'],
            ":birthDate" => $_POST['birthDate'],
            ":major" => $_POST['major'],
            ":class" => $_POST['class']
        ];
        $studentModel->updateStudentById($studentId, $dataMap);
        echo "更新数据成功";
        $this->jump("index.php?c=student&a=list");
    }

    /**
     * 删除学生信息。
     * @return void
     */
    #[NoReturn] public function deleteAction(): void
    {
        if ($this->isAdmin()){
            include 'application/views/admin/student_delete.php';
        }else {
            $this->jump("index.php?c=admin&a=login");
        }

    }
    /**
     * 处理学生删除操作。
     * 验证登录凭据并为学生启动会话。
     * @return void
     */
    #[NoReturn] public function handleDeleteAction():void
    {
        $studentId = $_REQUEST['studentId'];
        (new StudentModel())->deleteStudent($studentId);
        $this->jump("index.php?c=student&a=list");
    }

    /**
     * 检查学生信息。
     * @return void
     */
    public function checkAction()
    {
        // 检查逻辑
    }

    /**
     * 显示学生列表页面。
     * @return void
     */
    public function listAction(): void
    {
        include "application/views/admin/student_list.php";
    }

    /**
     * 根据学生ID获取学生信息。
     * @param int $studentId 学生ID
     * @return array 学生信息
     */
    public function getAction($studentId)
    {
        $studentModel = new StudentModel();
        return $studentModel->getStudentById($studentId);
    }

    /**
     * 获取学生选修的课程列表。
     * @return array 选修课程列表
     */
    public function getCourseSelectedAction(){
        $studentId = $_POST['studentId'];
        $studentModel = new StudentModel();
        return $studentModel->getCourseSelected($studentId);
    }

    /**
     * 处理学生登录操作。
     * 验证登录凭据并为学生启动会话。
     * @return void
     */
    #[NoReturn] public function handleLoginAction(): void
    {
        // 判断如果请求方法不是POST则结束
        if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
            die('Bad request');
        }
        if (empty($_POST)) {
            die('用户名和密码不能为空');
        }
        // 实例化student模型
        $studentModel = new StudentModel();
        // 调用验证方法如果失败则结束
        if (!$studentModel->checkByLogin()) {
            die('登录失败，用户名或密码错误。');
        }
        // 登录成功
        session_start();
        $_SESSION['identify'] = 'user';
        $_SESSION['user'] = $_POST['username'];
        $_SESSION['nickname'] = $studentModel->getUserNickname();
        // 跳转到主页
        $this->jump("index.php?c=student&a=home");
    }

    /**
     * 根据用户名获取学号
     *
     * @param string $username  用户名
     * @return string 学号
     */
    public function getStudentNumberByUsername(string $username): string
    {
        return (new studentModel())->getStudentNumberByUsername($username);
    }

    /**
     * 根据学生名获取学号
     *
     * @return int id
     */
    public function getStudentIdByUsername(string $username): int
    {
        return (new studentModel())->getStudentIdByUsername($username);
    }

    /**
     * 显示学生主页。
     * @return void
     */
    public function homeAction(): void
    {
        $greeting = $this->getGreeting();
        include "application/views/user/student_home.php";
    }

    /**
     * 显示学生课程列表页面。
     * @return void
     */
    public function courseListAction()
    {
        include "application/views/user/student_course_list.php";
    }
    /**
     * 显示学生成绩列表页面。
     * @return void
     */
    public function gradeListAction()
    {
        $studentId = $this->getStudentIdByUsername($_SESSION["user"]);
        include "application/views/user/student_grade.php";
    }

    /**
     * 显示学生信息页面。
     * @return void
     */
    public function infoAction(): void
    {
        $studentNumber = $this->getStudentNumberByUsername($_SESSION["user"]);
        $studentId = $this->getStudentIdByUsername($_SESSION["user"]);
        include "application/views/user/student_info.php";
    }

    /**
     * 显示绑定学号界面。
     * @return void
     */
    public function updateStudentNumberAction(): void
    {
        include "application/views/user/student_bind_information.php";
    }

    /**
     * 处理更新学号
     *
     * @return void
     */
    public function handleUpdateStudentNumberAction(): void
    {
        $studentNumber = $_POST["studentNumber"];
        $studentId = $this->getStudentIdByUsername($_SESSION["user"]);
        (new StudentModel())->updateStudentIdInUserStudent($studentNumber,$studentId);
        $this->jump("index.php?c=student&a=info");
    }




    /**
     * 显示更改密码页面。
     * @return void
     */
    public function changePasswordAction(): void
    {
        include 'application/views/user/student_change_password.php';
    }

    /**
     * 处理更改密码操作。
     * 检查输入并更新密码。
     * @return void
     */
    public function handleChangePasswordAction() : void
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            die("账号密码不能为空");
        }
        if (!($_POST['newPassword'] == $_POST['confirmNewPassword'])) {
            die("输入的两次新密码不一致");
        }
        if (!(new StudentModel())->checkByLogin()) {
            die("密码错误，请检查您的密码");
        }
        $this->changePassword();
    }

    /**
     * 更改学生密码并清理会话。
     * @return void
     */
    private function changePassword(): void
    {
        $studentModel = new StudentModel();
        $studentModel->updatePassword();
        session_unset();
        include 'application/views/public/login.php';
    }
}
