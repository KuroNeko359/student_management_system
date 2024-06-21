<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/static/css/edit.css">

    <title>Document</title>

</head>
<body>


<div class="container">
    <h2>编辑</h2>
    <form method="post" action="/index.php?c=student&a=update">

        <?php

        use \application\models\StudentModel;

        $studentId = $_REQUEST["studentId"];
        $studentController = new \application\models\StudentModel();
        $result = $studentController->getStudentById($studentId);
        ?>

        <div class="form-group">
            <label for="studentId">ID</label>
            <input id="studentId" readonly name="studentId" type="text" class="input"
                   value="<?php echo $result['student_id']; ?>"/>
        </div>
        <div class="form-group">
            <label for="studentNumber">学号</label>
            <input id="studentNumber" name="studentNumber" type="text" class="input"
                   value="<?php echo $result['student_number']; ?>"/>
        </div>
        <div class="form-group">
            <label for="studentName">姓名</label>
            <input id="studentName" name="studentName" type="text" class="input"
                   value="<?php echo $result['student_name']; ?>"/>
        </div>
        <div class="form-group">
            <label for="gender">性别</label>
            <input id="gender" name="gender" type="text" class="input" value="<?php echo $result['gender']; ?>"/>
        </div>
        <div class="form-group">
            <label for="birthDate">出生日期</label>
            <input id="birthDate" name="birthDate" type="text" class="input"
                   value="<?php echo $result['birth_date']; ?>"/>
        </div>
        <div class="form-group">
            <label for="major">专业</label>
            <input id="major" name="major" type="text" class="input" value="<?php echo $result['major']; ?>"/>
        </div>
        <div class="form-group">
            <label for="class">班级</label>
            <input id="class" name="class" type="text" class="input" value="<?php echo $result['class']; ?>"/>
        </div>
        <input type="submit" class="submit-button"/>

    </form>
</div>
</body>
</html>