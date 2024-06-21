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
    <h1>修改密码</h1>
    <form class="login-form" method="post" action="/index.php?c=admin&a=handleChangePassword">
        <label for="username">用户名</label>
        <input id="username" name="username" type="text" class="input"/>
        <label for="password">旧密码</label>
        <input id="password" name="password" type="password" class="input"/>
        <label for="newPassword">新密码</label>
        <input id="newPassword" name="newPassword" type="password" class="input"/>
        <label for="confirmNewPassword">确认新密码</label>
        <input id="confirmNewPassword" name="confirmNewPassword" type="password" class="input"/>
        <input type="submit" value="确认修改" class="login-button"/>
    </form>
</div>

</body>
</html>