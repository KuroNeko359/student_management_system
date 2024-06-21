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
    <h1>添加新学生</h1>
    <form class="login-form" method="post" action="/index.php?c=student&a=handleInsert">
        <label for="studentNumber">学号</label>
        <input id="studentNumber" name="studentNumber" type="text" class="input"/>
        <label for="studentName">姓名</label>
        <input id="studentName" name="studentName" type="text" class="input"/>
        <label for="gender">性别</label>
        <input id="gender" name="gender" type="text" class="input"/>
        <label for="birthDate">出生日期</label>
        <input id="birthDate" name="birthDate" type="text" class="input"/>
        <label for="major">专业</label>
        <input id="major" name="major" type="text" class="input"/>
        <label for="class">班级</label>
        <input id="class" name="class" type="text" class="input"/>
        <input type="submit" value="添加" class="login-button"/>
    </form>
</div>
</body>
</html>