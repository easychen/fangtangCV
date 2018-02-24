<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>用户注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <?php $is_login=false;include 'header.php' ?>
        <h1>用户注册</h1>
        <form action="user_save.php" method="post" id="form_reg" onsubmit="send_form('form_reg');return false;">
            <div id="form_reg_notice" class="form_info middle"></div>
            <p><input type="text" name="email" placeholder="Email" class="middle"/></p>
            <p><input type="password" name="password" placeholder="密码（6~12个字符）" class="middle"></p>
            <p><input type="password" name="password2" placeholder="重复密码" class="middle"></p>
            <p><input type="submit" value="注册" class="middle-button"></p>
        </form>
    </div>
</body>
</html>