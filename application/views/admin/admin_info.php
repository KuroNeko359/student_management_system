<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生管理系统</title>
    <link rel="stylesheet" href="/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="/static/css/header.css">
</head>
<body>
<?php require 'admin_header.php' ?>
<table>
    <tr>
        <th>身份</th>
        <td>管理员</td>
    <tr>
    <tr>
        <th>昵称</th>
        <td><?php echo $_SESSION['nickname'] ?></td>
    <tr>
    <tr>
        <th>用户名</th>
        <td><?php echo $_SESSION['user'] ?></td>
    <tr>
    <tr>
        <th>选项</th>
        <td><a href="/index.php?c=admin&a=changePassword">修改密码</a></td>
    <tr>
</table>
</body>
</html>
