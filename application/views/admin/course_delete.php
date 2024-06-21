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
        <h1>你确定要删除这门课程吗？</h1>
        <form id="login-form" class="login-form" method="post" action="/index.php?c=student&a=handleDelete&courseId=<?php echo $_REQUEST["courseId"]?>">
            <label for="confirm">请输入：我确定</label>
            <input id="confirm" name="confirm" type="text" class="input"/>

            <input type="submit" value="删除" id="delete" class="delete-button"/>
        </form>
    </div>

    <script>
        const deleteButton = document.getElementById('delete');
        const confirmInput = document.getElementById('confirm');

        deleteButton.addEventListener('click', function(event) {
            if (confirmInput.value.trim() !== '我确定') {
                event.preventDefault(); // 阻止表单提交
                alert('如果想要删除,请输入正确的确认词：“我确定”'); // 提示用户输入正确的确认词
            }
        });
    </script>

</body>
</html>