<div class="headbox">
            <?php if( $is_login ): ?>
            <ul class="menu">
                <li><span class="menu_square"></span><a href="resume_list.php">我的简历</a></li>
                <li><span class="menu_square"></span><a href="user_logout.php">退出</a></li>
            </ul>
            <?php else: ?>
            <ul class="menu">
                <li><span class="menu_square"></span><a href="user_reg.php">注册</a></li>
                <li><span class="menu_square"></span><a href="user_login.php">登入</a></li>
            </ul>
            <?php endif; ?>
            <div class="logo"><a href="index.php"><img src="image/logo.png" alt="方糖简历logo"/></a></div>
        </div>