<?php
namespace application\models;

use core\base\Model;

/**
 * AdminModel 类
 * 管理员相关操作的数据模型。
 */
class AdminModel extends Model {

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

        $sql = "SELECT * FROM user_teacher WHERE username=:username AND password = MD5(:password)";
        $data = $this->db->fetchRow($sql, array(':username' => $username, ':password' => $password));
        if (!$data) {
            return false;
        }
        return true;
    }

    /**
     * 更新密码。
     * 将用户的密码更新为新密码。
     * @return void
     */
    public function updatePassword(): void
    {
        // 过滤输入数据
        $this->filter(array('username', 'password'), 'trim');
        $sql = "UPDATE user_teacher SET password=MD5(:newPassword) WHERE username=:username AND password=MD5(:password)";
        $this->db->execute($sql, array(
            ':username' => $_POST['username'],
            ':password' => $_POST['password'],
            ':newPassword' => $_POST['newPassword'],
        ));
    }

    /**
     * 获取用户昵称。
     * 根据用户名从数据库中获取用户的昵称。
     * @return string 用户昵称
     */
    public function getUserNickname()
    {
        $sql = "SELECT `nickname` FROM user_teacher WHERE `username`=:username";
        return $this->db->fetchRow($sql, array(
            ':username' => $_POST['username'],
        ))["nickname"];
    }
}
