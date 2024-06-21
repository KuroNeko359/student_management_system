<?php

namespace application\controllers;

use application\models\CourseModel;
use core\base\Controller;

use JetBrains\PhpStorm\NoReturn;

class CourseController extends Controller
{

    /**
     * 打印欢迎信息。
     * @return void
     */
    public function helloAction(): void
    {
        echo "Hello! This is StudentController";
    }

    /**
     * 显示插入课程的页面。
     * @return void
     */
    public function insertAction(): void
    {
        if ($this->isAdmin()){
            include "application/views/admin/course_insert.php";
        }else {
            $this->jump("index.php?c=admin&a=login");
        }
    }

    /**
     * 处理插入课程操作。
     * @return void
     */
    #[NoReturn] public function handleInsertAction(): void
    {
        (new CourseModel())->insertCourse();
        $this->jump("/index.php?c=course&a=list");
    }

    /**
     * 显示编辑课程的页面。
     * @return void
     */
    public function editAction(): void
    {
        if ($this->isAdmin()){
            include "application/views/admin/course_edit.php";
        }else {
            $this->jump("index.php?c=admin&a=login");
        }
    }

    /**
     * 处理更新课程操作。
     * @return void
     */
    #[NoReturn] public function updateAction(): void
    {
        $courseModel = new CourseModel();
        $courseId = $_POST['courseId'];

        $dataMap = [
            ":courseName" => $_POST['courseName'],
            ":courseDescription" => $_POST['courseDescription'],
            ":credits" => $_POST['credits']
        ];
        $courseModel->updateCourseById($courseId, $dataMap);
        echo "更新数据成功";
        $this->jump("index.php?c=course&a=list");
    }

    /**
     * 显示课程详细信息页面。
     * @return void
     */
    public function detailAction(): void
    {
        include "application/views/public/course_detail.php";
    }

    /**
     * 显示课程列表页面。
     * @return void
     */
    public function listAction(): void
    {
        include "application/views/admin/admin_course_list.php";
    }

    /**
     * 根据学生ID获取课程信息。
     * @param int $studentId 学生ID
     * @return array 课程信息
     */
    public function getAction($studentId)
    {
        $courseModel = new CourseModel();
        return $courseModel->getCourseById($studentId);
    }


    /**
     * 删除学生信息。
     * @return void
     */
    public function deleteAction(): void
    {
        if ($this->isAdmin()){
            include 'application/views/admin/course_delete.php';
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
        $courseId = $_REQUEST['courseId'];
        (new CourseModel())->deleteCourse($courseId);
        $this->jump("index.php?c=course&a=list");
    }
}
