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
<h1>学生信息</h1>
<table>
    <?php

    use \application\models\StudentModel;

    $studentId = $_REQUEST["studentId"];
    $studentModel = new \application\models\StudentModel();
    $result = $studentModel->getStudentById($studentId);
    ?>
    <tr>
        <th>ID</th>
        <td><?php echo $result['student_id'] ?></td>
    </tr>
    <tr>
        <th>学号</th>
        <td><?php echo $result['student_number'] ?></td>
    </tr>
    <tr>
        <th>姓名</th>
        <td><?php echo $result['student_name'] ?></td>
    </tr>
    <tr>
        <th>性别</th>
        <td>
            <?php
            if ($result['gender'] == "M") {
                echo "男";
            } else echo "女";
            ?>
        </td>
    </tr>
    <tr>
        <th>生日</th>
        <td><?php echo $result['birth_date'] ?></td>
    </tr>
    <tr>
        <th>专业</th>
        <td><?php echo $result['major'] ?></td>
    </tr>
    <tr>
        <th>班级</th>
        <td><?php echo $result['class'] ?></td>
    </tr>

</table>
<h1>选课与成绩</h1>
<table>
    <tr>
        <th>课程名</th>
        <th>学分</th>
        <th>成绩</th>
    <tr>
        <?php
        $courseSelectedResult = $studentModel->getCourseSelected($studentId);
        foreach ($courseSelectedResult as $courseSelected) {
            echo "<tr>"; // 开始每一行
            echo "<td>" . $courseSelected["course_name"] . "</td>"; // 输出课程名
            echo "<td>" . $courseSelected["credits"] . "</td>"; // 输出课程名
            echo "<td>" . $courseSelected["grade"] . "</td>"; // 输出课程名
            echo "</tr>"; // 结束当前行
        }
        ?>
</table>


</body>
</html>