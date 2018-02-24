<?php

error_reporting( E_ALL & ~E_NOTICE );

// 获取输入参数
$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );

// 参数检查
if( strlen( $email ) < 1 ) die("Email 地址不能为空");
if( mb_strlen( $password ) < 6 ) die("密码不能短于6个字符");
if( mb_strlen( $password ) > 12 ) die("密码不能长于12个字符");

if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) )
{
    die("Email 地址错误");
}

// die("数据OK");
// 链接数据库
try
{
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1";

    $sth = $dbh->prepare( $sql );
    $ret = $sth->execute( [ $email ] );
    $user = $sth->fetch(PDO::FETCH_ASSOC);

    if( !password_verify( $password , $user['password'] ) )
    {
        // print_r( $user );
        die("错误的Email地址或者密码");
    }

    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['uid'] = $user['id'];

    die("登入成功<script>location='resume_list.php'</script>");


    
    // header("Location: user_login.php");
    die("用户注册成功<script>location='user_login.php'</script>");
}
catch( PDOException $Exception )
{
    if( $Exception->getCode() == 23000 )
    {
        die("Email地址已被注册");
    }
    else
    {
        die( $Exception->getMessage() );
    }  
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}


// echo $sql;