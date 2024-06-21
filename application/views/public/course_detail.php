<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">
    <title>Document</title>
</head>
<body>
<h1>课程信息</h1>
<table>
    <?php

    use \application\models\StudentModel;

    $courseId = $_REQUEST["courseId"];
    $studentModel = new \application\models\CourseModel();
    $result = $studentModel->getCourseById($courseId);
    ?>
    <tr>
        <th>ID</th>
        <td><?php echo $result['course_id'] ?></td>
    </tr>
    <tr>
        <th>课程名</th>
        <td><?php echo $result['course_name'] ?></td>
    </tr>
    <tr>
        <th>课程描述</th>
        <td style="word-wrap:break-word;word-break:break-all;width: 100px"><?php echo $result['course_description'] ?></td>
    </tr>
    <tr>
        <th>学分</th>
        <td><?php echo $result['credits'] ?></td>
    </tr>

</table>


</body>
</html>