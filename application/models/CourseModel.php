<?php

namespace application\models;

use core\base\Model;

/**
 * CourseModel 类
 * 处理课程相关操作的数据模型。
 */
class CourseModel extends Model
{

    /**
     * 测试方法。
     */
    public function test()
    {
        // 此方法用于测试
    }

    /**
     * 获取所有课程。
     * 从数据库中获取所有课程信息。
     * @return array 所有课程的数据
     */
    public function getAllCourse()
    {
        return $this->db->fetchAll("SELECT * FROM courses");
    }

    /**
     * 根据课程ID获取课程信息。
     * @param int $id 课程ID
     * @return array 课程的数据
     */
    public function getCourseById($id)
    {
        return $this->db->fetchRow("SELECT * FROM courses WHERE course_id = ?", [$id]);
    }

    /**
     * 根据学生ID获取学生信息
     * @param int $student_id 学生ID
     * @param $course_id
     * @return string 课程的数据
     */
    public function getGradeByStudentIdAndCourseId(int $student_id, $course_id):string
    {
        return $this->db->fetchRow("
            SELECT
                c.course_name AS course_name,
                c.credits AS credits,
                e.grade AS grade
            FROM enrollments e
            JOIN courses c ON c.course_id = e.course_id
            WHERE e.student_id = :student_id AND e.course_id = :course_id;
        ",
            array(
            ":student_id" => $student_id,
            ":course_id" => $course_id
        )
        )["grade"];
    }

    /**
     * 根据课程ID更新课程信息。
     * @param int $id 课程ID
     * @param array $data 要更新的课程数据
     * @return void
     */
    public function updateCourseById($id, $data): void
    {
        $sql = "UPDATE courses
                SET `course_name` = :courseName,
                    `course_description` = :courseDescription,
                    `credits` = :credits
                WHERE `course_id` = " . $id;
        $this->db->execute($sql, $data);
    }

    /**
     * 插入新课程。
     * 将新课程数据插入到数据库中。
     * @return void
     */
    public function insertCourse(): void
    {
        $courseName = $_POST['courseName'];
        $courseDescription = $_POST['courseDescription'];
        $credits = $_POST['credits'];
        $sql = "
            INSERT INTO `courses`(course_name, course_description, credits)
            VALUES (:courseName, :courseDescription, :credits)
        ";
        $this->db->execute($sql, array(
            ':courseName' => $courseName,
            ':courseDescription' => $courseDescription,
            ':credits' => $credits
        ));
    }

    /**
     * 删除课程。
     * @return void
     */
    public function deleteCourse(): void
    {
        $sql = "DELETE FROM courses WHERE course_id=:courseId";
        $this->db->execute($sql, array(
            ':courseId' => $_POST['courseId']
        ));
    }
}
