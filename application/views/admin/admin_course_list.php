<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="/static/css/header.css">
    <title>Document</title>
</head>
<body>
<?php require "admin_header.php" ?>
<main>
    <br>
    <?php

    use application\models\CourseModel;
    ?>
    <div style="display: flex">
        <h1 style='width: 90%;'>课程列表</h1>
        <a href="/index.php?c=course&a=insert">
            <img src="/static/img/add_course.svg" style="height: 100%;width: 100%" alt="">
        </a>
    </div>

    <?php
    $result = (new \application\models\CourseModel())->getAllCourse();
    echo "<table>";
    echo "<thead>
                <tr>
                    <th>课程ID</th>
                    <th>课程名</th>
                    <th>课程描述</th>
                    <th>学分</th>
                    <th>选项</th>
                </tr>
              </thead>
              <tbody>";
    // 设置每页显示的记录数
    $records_per_page = 15;

    // 计算总记录数
    $total_records = count($result);

    // 计算总页数
    $total_pages = ceil($total_records / $records_per_page);

    // 假设当前页数为 $_GET['page']，如果未设置默认为第一页
    $current_page = $_GET['page'] ?? 1;

    // 计算起始位置
    $start_index = ($current_page - 1) * $records_per_page;

    // 取出当前页的记录
    $records_to_display = array_slice($result, $start_index, $records_per_page);

    foreach ($result as $course) {
        echo "<tr>
                    <td>" . $course['course_id'] . "</td>
                    <td>" . $course['course_name'] . "</td>
                    <td style='white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 300px;'>" . $course['course_description'] . "</td>
                    <td>" . $course['credits'] . "</td>
                    <td>
                        <a href='/index.php?c=course&a=edit&courseId=" . $course['course_id'] . "' class='edit-button'><img src='/static/img/edit_file.svg' alt=''></a>
                        <a href='/index.php?c=course&a=detail&courseId=" . $course['course_id'] . "' class='edit-button'><img src='/static/img/detail.svg' alt=''></a>
                                                <a href='/index.php?c=course&a=delete&courseId=".$course['course_id']."' class='edit-button'><img src='/static/img/delete.svg' alt=''></a>
                    </td>
                  </tr>";
    }
    echo "</tbody></table>";

    echo "</tbody></table>";
    // 首页和上一页按钮
    if ($current_page > 1) {
        echo "<a href='/index.php?c=course&a=list&page=1'><img src='/static/img/double_left.svg' alt=''></a>";
        echo "<a href='/index.php?c=course&a=list&page=" . ($current_page - 1) . "'><img src='/static/img/left.svg' alt=''></a>";
    } else {
        echo "<span><img src='/static/img/double_left.svg' alt=''></span>";
        echo "<span><img src='/static/img/left.svg' alt=''></span>";
    }

    // 下一页和末页按钮
    if ($current_page < $total_pages) {
        echo "<a href='/index.php?c=course&a=list&page=" . ($current_page + 1) . "'><img src='/static/img/right.svg' alt=''></a>";
        echo "<a href='/index.php?c=course&a=list&page=" . $total_pages . "'><img src='/static/img/double_right.svg' alt=''></a>";
    } else {
        echo "<span><img src='/static/img/right.svg' alt=''></span>";
        echo "<span><img src='/static/img/double_right.svg' alt=''></span>";
    }
    ?>
</main>
<footer>
    <p>&copy; 2024 Student Management System. All rights reserved.</p>
</footer>
</body>
</html>