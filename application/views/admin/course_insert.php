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
    <h1>添加新课程</h1>
    <form class="login-form" method="post" action="/index.php?c=course&a=handleInsert">
        <label for="courseName">课程名称</label>
        <input id="courseName" name="courseName" type="text" class="input"/>
        <label for="courseDescription">课程描述</label>
        <input id="courseDescription" name="courseDescription" type="text" class="input"/>
        <label for="credits">学分</label>
        <input id="credits" name="credits" type="text" class="input"/>
        <input type="submit" value="添加" class="login-button"/>
    </form>
</div>
</body>
</html>