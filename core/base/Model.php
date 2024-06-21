<?php

namespace core\base;

use core\MySQLConnector;

/**
 * Model 基类
 * 提供基本的模型功能，包括数据库初始化和输入过滤。
 */
class Model
{
    protected $db; // 数据库连接实例

    /**
     * 构造方法
     * 初始化数据库连接。
     */
    public function __construct()
    {
        $this->initDB();
    }

    /**
     * 初始化数据库连接
     * 使用 MySQLConnector 获取数据库连接实例。
     */
    public function initDB()
    {
        $this->db = MySQLConnector::getInstance();
    }

    /**
     * 输入过滤方法
     * 对指定字段进行输入过滤，调用指定的处理函数。
     * @param array $arr 需要处理的字段数组
     * @param callable $func 用于处理的回调函数
     */
    protected function filter($arr, $func)
    {
        foreach ($arr as $v) {
            // 如果字段不存在，默认为空字符串
            if (!isset($_POST[$v])) {
                $_POST[$v] = '';
            }
            // 调用指定的处理函数
            $_POST[$v] = $func($_POST[$v]);
        }
    }
}
