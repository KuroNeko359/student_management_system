<?php

namespace core;

use PDO;
use PDOException;

class MySQLConnector
{
    //数据库默认连接信息
    private $dbConfig;
    //单例模式，本类对象引用
    private static $instance;
    //PDO实例
    private $db;

    /**
     * 私有构造方法
     * @param $params array 数据库连接信息
     *
     */
    private function __construct($params)
    {
        $this->dbConfig = require './config/mysql.conf.php';
        //初始化属性
        $this->dbConfig = array_merge($this->dbConfig, $params);
        //连接服务器
        $this->connect();
    }


    /**
     * 获得单例对象
     * @param $params array 数据库连接信息
     * @return object 单例的对象
     */
    public static function getInstance(array $params = array()): object
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($params);
        }
        return self::$instance; //返回对象
    }

    /**
     * 私有克隆
     */
    private function __clone()
    {

    }

    /**
     * 连接目标服务器
     */
    private function connect(): void
    {
        try {
            //连接信息
            $dsn = "{$this->dbConfig['db']}:host={$this->dbConfig['host']};
	    		port={$this->dbConfig['port']};
				dbname={$this->dbConfig['dbname']};
				charset={$this->dbConfig['charset']}";
            //实例化PDO
            $this->db = new PDO($dsn, $this->dbConfig['user'], $this->dbConfig['pass']);
            //设定字符集
            $this->db->query("set names {$this->dbConfig['charset']}");
        } catch (PDOException $e) {
            //错误提示
            die("数据库连接失败:{$e->getMessage()}");
        }
    }

    /**
     * 执行SQL语句
     * @param $sql string 执行的SQL语句
     * @return object PDOStatement
     */
    public function query(string $sql): object
    {
        $rst = $this->db->query($sql);
        if ($rst === false) {
            $error = $this->db->errorInfo();
            die("数据库表操作失败:ERROR{$error[1]}({$error[0]}:{$error[2]})");
        }
        return $rst;
    }

    /**
     * 预处理方式执行SQL
     * @param $sql string 执行的SQL语句
     * @param $data array 数据数组
     * @param &$flag bool 是否执行成功
     * @return object PDOStatement
     */
    public function execute(string $sql, array $data, bool &$flag = true): object
    {
        $stmt = $this->db->prepare($sql);
        $flag = $stmt->execute($data);
        return $stmt;
    }

    /**
     * 取得一行记录
     * @param $sql string 执行SQL语句
     * @return array 关联数组结果
     */
    public function fetchRow(string $sql, $data = array())
    {
        return $this->execute($sql, $data)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 取得所有结果
     * @param $sql string 执行的SQL语句
     * @return array 关联数组结果
     */
    public function fetchAll(string $sql, $data = array()): array
    {
        return $this->execute($sql, $data)->fetchAll(PDO::FETCH_ASSOC);
    }

}