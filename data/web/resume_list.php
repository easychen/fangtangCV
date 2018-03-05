<?php
session_start();
if( intval( $_SESSION['uid'] ) < 1 )
{
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历"); 
}

$is_login = true;

try
{
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `uid` = ? AND `is_deleted` != 1";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ intval( $_SESSION['uid'] ) ] );
    $resume_list = $sth->fetchAll(PDO::FETCH_ASSOC);
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}

?><!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" media="screen" href="app.css" />

    <title>我的简历</title>
  </head>
  <body>
    <!-- 页面内容区域 -->
    <div class="container">
        <?php include 'header.php'; ?>
        <h1 class="page-title">我的简历</h1>
        <div class="page-box">
        <?php if( $resume_list ): ?>
        <ul class="list-group">
        <?php foreach( $resume_list  as $item ): ?>
            <li id="rlist-<?=$item['id']?>" class="list-group-item list-group-item-action">
            <a href="resume_detail.php?id=<?=$item['id']?>" class="btn btn-light" target="_blank"><?=$item['title']?></a> 
                <a href="resume_detail.php?id=<?=$item['id']?>"  target="_blank"><img src="image/open_in_new.png" alt="查看"></a>
                <a href="resume_modify.php?id=<?=$item['id']?>"><img src="image/mode_edit.png" alt="编辑"></a>
                <a href="javascript:confirm_delete('<?=$item['id']?>');void(0);"><img src="image/close.png" alt="删除"></a>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php endif;?>
        <p><a href="resume_add.php" class="resume_add btn btn-light"><img src="image/add.png" alt="添加简历"> 添加简历</a></p>
        </div>
        
    </div>
    
        <!-- /页面内容区域 -->
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    </body>
</html>