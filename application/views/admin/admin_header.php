<header>
    <div class="header">
        <div style="display: flex">
            <img src="/static/img/management_system.svg" alt="">
            <h2><a href="/index.php?c=admin&a=home" style="height:100%;color: white;text-decoration: none;">学生管理系统</a></h2>
        </div>
        <nav>
            <ul>
                <li><a href="/index.php?c=student&a=list">学生列表</a></li>
                <li><a href="/index.php?c=course&a=list">课程列表</a></li>
                <li>你好,<a href="/index.php?c=admin&a=info"><?php echo $_SESSION['nickname'] ?></a></li>
                <li><a href="/index.php?c=admin&a=logout">登出</a></li>
            </ul>
        </nav>
    </div>
</header>
<br>