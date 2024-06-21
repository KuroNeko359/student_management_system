<?php
namespace application\models;

use core\base\Model;

/**
 * StudentModel 类
 * 处理学生相关操作的数据模型。
 */
class StudentModel extends Model {

    /**
     * 测试方法。
     */
    public function test()
    {
        // 此方法用于测试
    }

    /**
     * 验证登录信息。
     * 通过检查用户名和密码在数据库中的匹配来验证登录信息。
     * @return bool 登录验证是否成功
     */
    public function checkByLogin(): bool
    {
        // 过滤输入数据
        $this->filter(array('username', 'password'), 'trim');
        // 接收输入数据
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user_student WHERE username=:username AND password = MD5(:password)";
        $data = $this->db->fetchRow($sql, array(':username' => $username, ':password' => $password));
        if (!$data) {
            return false;
        }
        return true;
    }

    /**
     * 获取所有学生信息。
     * 从数据库中获取所有学生的信息。
     * @return array 所有学生的数据
     */
    public function getAllStudent()
    {
        return $this->db->fetchAll("SELECT * FROM students");
    }

    /**
     * 根据学生ID获取学生信息。
     * @param int $id 学生ID
     * @return array 学生的数据
     */
    public function getStudentById($id)
    {
        return $this->db->fetchRow("SELECT * FROM students WHERE student_id = ?", [$id]);
    }

    /**
     * 根据学生ID更新学生信息。
     * @param int $id 学生ID
     * @param array $data 要更新的学生数据
     * @return void
     */
    public function updateStudentById($id, $data): void
    {
        $sql = "UPDATE students
                SET `student_number` = :studentNumber,
                    `student_name` = :studentName,
                    `gender` = :gender,
                    `birth_date` = :birthDate,
                    `major` = :major,
                    `class` = :class
                WHERE `student_id` = ".$id;
        $this->db->execute($sql, $data);
    }

    /**
     * 获取学生已选课程信息。
     * @param int $studentId 学生ID
     * @return array 学生已选课程的数据
     */
    public function getCourseSelected($studentId)
    {
        return $this->db->fetchAll("
        SELECT
            c.course_name AS course_name,
            c.credits AS credits,
            e.grade AS grade
        FROM enrollments e
                 JOIN courses c ON c.course_id = e.course_id
        WHERE e.student_id = ?;
        ", [$studentId]);
    }

    /**
     * 获取用户昵称。
     * 根据用户名从数据库中获取用户的昵称。
     * @return string 用户昵称
     */
    public function getUserNickname()
    {
        $sql = "SELECT `nickname` FROM user_student WHERE `username`=:username";
        return $this->db->fetchRow($sql, array(
            ':username' => $_POST['username'],
        ))["nickname"];
    }

    /**
     * 更新密码。
     * 将用户的密码更新为新密码。
     * @return void
     */
    public function updatePassword(): void
    {
        $this->filter(array('username', 'password'), 'trim');
        $sql = "UPDATE user_student SET password=MD5(:newPassword) WHERE username=:username AND password=MD5(:password)";
        $this->db->execute($sql, array(
            ':username' => $_POST['username'],
            ':password' => $_POST['password'],
            ':newPassword' => $_POST['newPassword'],
        ));
    }

    /**
     * 删除用户。
     * @return void
     */
    public function deleteStudent($studentId): void
    {
        $sql = "DELETE FROM students WHERE student_id=:studentId";
        $this->db->execute($sql, array(
            ':studentId' => $studentId
        ));
    }

    /**
     * 插入新学生。
     * 将新学生数据插入到数据库中。
     * @return void
     */
    public function insertStudent(): void
    {
        $studentNumber = $_POST['studentNumber'];
        $studentName = $_POST['studentName'];
        $gender = $_POST['gender'];
        $birthDate = $_POST['birthDate'];
        $major = $_POST['major'];
        $class = $_POST['class'];
        $sql = "
            INSERT INTO `students`(student_number, student_name, gender, birth_date, major, class)
            VALUES (:studentNumber, :studentName, :gender, :birthDate, :major, :class)
        ";
        $this->db->execute($sql, array(
            ':studentNumber' => $studentNumber,
            ':studentName' => $studentName,
            ':gender' => $gender,
            ':birthDate' => $birthDate,
            ':major' => $major,
            ':class' => $class
        ));
    }

    /**
     * 根据用户名获取学号
     * @return string 学号
     */
    public function getStudentNumberByUsername($username):string
    {
        $sql = "SELECT student_number FROM user_student WHERE username = :username";
        return $this->db->fetchRow($sql, array(
            ":username" => $username,
        ))["student_number"]  ?? "";
    }

    /**
     * 根据用户名获取ID
     * @return int ID
     */
    public function getStudentIdByUsername($username):int
    {
        $sql = "SELECT student_id FROM user_student WHERE username = :username";
        return $this->db->fetchRow($sql, array(
            ":username" => $username,
        ))["student_id"];
    }

    public function updateStudentIdInUserStudent($studentNumber, $studentId): void
    {
        $sql = "
        UPDATE `user_student`
        SET `student_number` = :student_number
        WHERE `student_id` = :student_id;";
        $this->db->execute($sql, array(
            ":student_number" => $studentNumber,
            ":student_id" => $studentId
        ));
    }

    public function getGradeByStudentId($studentId)
    {
        $sql = "SELECT
            c.course_id,
            c.course_name,
            c.credits,
            e.grade
        FROM enrollments e
        JOIN courses c on e.course_id = c.course_id
        WHERE e.student_id = :student_id;";
        return $this->db->fetchAll($sql, array(
            ":student_id" => $studentId
        ));
    }

}
