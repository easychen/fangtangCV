<?php
namespace FangFrame\Controller;

class User
{
    public function login()
    {
        $data['title'] = "用户登入🤠";
        render( $data );
    }

    public function login_check()
    {
        // 获取输入参数
        $email = trim( v('email') );
        $password = trim( v('password') );

        // 参数检查
        if( strlen( $email ) < 1 ) e("Email 地址不能为空");
        if( mb_strlen( $password ) < 6 ) e("密码不能短于6个字符");
        if( mb_strlen( $password ) > 12 ) e("密码不能长于12个字符");

        if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) )
        {
            e("Email 地址错误");
        }

        
        if( $user_list = get_data( "SELECT * FROM `user` WHERE `email` = ? LIMIT 1" , [ $email ] ))
        {
            $user = $user_list[0];
        }
        

        
        if( !password_verify( $password , $user['password'] ) )
        {
            // print_r( $user );
            e("错误的Email地址或者密码");
        }

        

        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['uid'] = $user['id'];

        die("登入成功<script>location='resume_list.php'</script>");
        

    }
}