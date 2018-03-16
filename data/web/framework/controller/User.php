<?php
namespace FangFrame\Controller;

class User
{
    public function login()
    {
        $data['title'] = "用户登入";
        render_layout( $data );
    }

    public function logout()
    {
        if( !headers_sent() )
            session_start();

        foreach( $_SESSION as $key => $value )
        {
            unset( $_SESSION[$key] );
        }

        header( "Location: /" );
    }

    public function register()
    {
        $data['title'] = "用户注册";
        render_layout( $data );
    }

    public function save()
    {
        // 获取输入参数
        $email = trim( v('email') );
        $password = trim( v('password') );
        $password2 = trim( v('password2') );

        // 参数检查
        if( strlen( $email ) < 1 ) e("Email 地址不能为空");
        if( mb_strlen( $password ) < 6 ) e("密码不能短于6个字符");
        if( mb_strlen( $password ) > 12 ) e("密码不能长于12个字符");
        if( strlen( $password2 ) < 1 ) e("重复密码不能为空");

        if( $password != $password2 ) e("两次输入的密码不一致");

        if( !filter_var( $email , FILTER_VALIDATE_EMAIL ) )
        {
            e("Email 地址错误");
        }

        $sql = "INSERT INTO `user` ( `email` , `password` , `created_at` ) VALUES ( ? , ? , ? )";

        $ret = run_sql( $sql , [ $email , password_hash( $password , PASSWORD_DEFAULT ) , date( "Y-m-d H:i:s" )  ] , 1062 , "Email地址已被注册" );

        echo $info = "用户注册成功<script>location='/?m=user&a=login'</script>";
        return $info;
        
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

        echo "登入成功<script>location='/?m=resume&a=list'</script>";
        return true;
        

    }
}