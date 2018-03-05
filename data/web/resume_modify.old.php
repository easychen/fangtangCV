<?php
session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历"); 
}

$id = intval( $_REQUEST['id'] );
if( $id < 1 ) die("错误的简历ID");

try
{
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `resume` WHERE `id` = ? LIMIT 1";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ $id ] );
    $resume = $sth->fetch(PDO::FETCH_ASSOC);

    if( $resume['uid'] != $_SESSION['uid'] ) die("只能修改自己的简历");
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>修改简历</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h1>修改简历</h1>
        <form action="resume_update.php" method="post" id="form_resume" onsubmit="send_form('form_resume');return false;">
            <div id="form_resume_notice" class="form_info full"></div>
            
            <p><input type="text" name="title" placeholder="简历名称" class="full" value="<?=$resume['title']?>"/></p>

            <p><textarea name="content" placeholder="简历内容，支持 Markdown 语法" class="full"><?=htmlspecialchars( $resume['content'] ) ?></textarea></p>

            <input type="hidden" name="id" value="<?=$resume['id']?>"/>
            <p><input type="submit" value="更新简历" class="middle-button"><input type="button" value="返回" class="middle-button cancel-button" onClick="history.back(1);void(0);"></p>
        </form>
    </div>
</body>
</html>
