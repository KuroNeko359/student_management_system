<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>学生管理系统</title>
    <link rel="stylesheet" href="/static/css/styles.css">
</head>
<body>
<div class="sidebar">
    <h2>学生管理系统</h2>
    <ul>
        <li><a href="#" id="view-info">查看信息</a></li>
        <li><a href="#" id="select-courses">选课</a></li>
    </ul>
</div>
<div class="main-content">
    <div id="info-section" class="content-section">
        <h1>个人信息</h1>
        <div class="student-info">
            <div class="info-item">
                <label for="student-name">姓名:</label>
                <span id="student-name">张三</span>
            </div>
            <div class="info-item">
                <label for="student-id">学号:</label>
                <span id="student-id">20230101</span>
            </div>
            <div class="info-item">
                <label for="class">班级:</label>
                <span id="class">三年级一班</span>
            </div>
            <div class="info-item">
                <label for="phone">联系方式:</label>
                <span id="phone">123-4567-8901</span>
            </div>
            <div class="info-item">
                <label for="email">电子邮件:</label>
                <span id="email">zhangsan@example.com</span>
            </div>
        </div>
    </div>
    <div id="courses-section" class="content-section" style="display: none;">
        <h1>选课</h1>
        <div class="courses">
            <div class="course-item">
                <input type="checkbox" id="course1">
                <label for="course1">课程一</label>
            </div>
            <div class="course-item">
                <input type="checkbox" id="course2">
                <label for="course2">课程二</label>
            </div>
            <div class="course-item">
                <input type="checkbox" id="course3">
                <label for="course3">课程三</label>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('view-info').addEventListener('click', function () {
        document.getElementById('info-section').style.display = 'block';
        document.getElementById('courses-section').style.display = 'none';
    });

    document.getElementById('select-courses').addEventListener('click', function () {
        document.getElementById('info-section').style.display = 'none';
        document.getElementById('courses-section').style.display = 'block';
    });
</script>
</body>
</html>
