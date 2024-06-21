# 学生管理系统使用说明

## 测试环境

##### 操作系统 Windows11

##### PHP版本 > 8.0

##### 服务器 Apache

##### MySQL版本 5.7

## 搭建教程

### 1.修改Apache配置文件

修改`httpd.conf`文件

设置 `DocumentRoot `的参数为 `StudentManagementSystem `的根目录

一定要主要，项目的根目录为 `StudentManagementSystem `

例如：`DocumentRoot "D:/opt/xampp/htdocs/StudentManagementSystem"`

### 2.导入数据库文件 

使用 MySQL数据库中的 `SOURCE`语句导入数据库文件

```sql
SOURCE C:/Users/kuroneko/student_management_system-dump.sql
```

### 3.使用说明

默认用户： 
用户名：KuroNeko359 
密码：123

默认管理员用户： 
用户名：admin
密码：123