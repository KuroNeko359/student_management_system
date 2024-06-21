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
    <h1>绑定学生信息</h1>
    <form class="login-form" method="post" action="/index.php?c=student&a=handleUpdateStudentNumber">
        <label for="studentNumber">学号</label>
        <input id="studentNumber" name="studentNumber" type="text" class="input"/>
        <input type="submit" value="提交" class="login-button"/>
    </form>
</div>

</body>
</html>