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
    <h2>课程编辑</h2>
    <form method="post" action="/index.php?c=course&a=update">

        <?php

        use \application\models\StudentModel;

        $studentId = $_REQUEST["courseId"];
        $courseModel = new \application\models\CourseModel();
        $result = $courseModel->getCourseById($studentId);
        ?>

        <div class="form-group">
            <label for="courseId">课程ID</label>
            <input id="courseId" readonly name="courseId" type="text" class="input"
                   value="<?php echo $result['course_id']; ?>"/>
        </div>
        <div class="form-group">
            <label for="courseName">课程名</label>
            <input id="courseName" name="courseName" type="text" class="input"
                   value="<?php echo $result['course_name']; ?>"/>
        </div>
        <div class="form-group">
            <label for="courseDescription">课程描述</label>
            <textarea id="courseDescription" name="courseDescription"
                      class="input description"><?php echo $result['course_description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="credits">学分</label>
            <input id="credits" name="credits" type="text" class="input" value="<?php echo $result['credits']; ?>"/>
        </div>
        <input type="submit" class="submit-button"/>

    </form>
</div>
</body>
</html>