<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/static/css/login.css">

</head>
<body>

<div class="login-container">
    <h1>登录</h1>
    <form id="login-form" class="login-form" method="post" action="/index.php?c=student&a=handleLogin">
        <label for="username">用户名</label>
        <input id="username" name="username" type="text" class="input"/>

        <label for="password">密码</label>
        <input id="password" name="password" type="password" class="input"/>

        <label for="role">身份</label>
        <select id="role" name="role" class="input test" onchange="updateAction()">
            <option value="student">学生</option>
            <option value="admin">管理员</option>
        </select>

        <input type="submit" value="登录" class="login-button"/>
    </form>
</div>

<script>
    function updateAction() {
        const role = document.getElementById('role').value;
        const form = document.getElementById('login-form');
        if (role === 'student') {
            form.action = '/index.php?c=student&a=handleLogin';
        } else if (role === 'admin') {
            form.action = '/index.php?c=admin&a=handleLogin';
        }
    }
</script>

</body>
</html>