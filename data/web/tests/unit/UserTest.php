<?php
if( !defined('DS') ) define( 'DS' , DIRECTORY_SEPARATOR );
define( "ROOT" , __DIR__ . DS . '..' .  DS . '..' ); 
define( "FROOT" , ROOT. DS . "framework" );
define( "VIEW" , FROOT. DS . "view" );
include ROOT . DS . 'vendor' . DS . 'autoload.php';

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
        // 清理数据库
        $sql = "DELETE FROM `user` WHERE `email` LIKE '%@autotest.com' ";
        run_sql( $sql );

        $sql = "DELETE FROM `resume` WHERE `title` LIKE '%@test' ";
        run_sql( $sql );
    }

    // tests
    public function testGlobals()
    {
        $GLOBALS['User'] = 'Easy';
        $this->assertEquals( g('User') , 'Easy' );
        $this->assertFalse( g('User1') );
    }

    public function testUserLogin()
    {
        $_REQUEST['email'] = 'thetwo@gmail.com';
        $_REQUEST['password'] = 'php';

        $user = new FangFrame\Controller\User();
        try
        {
            $user->login_check();
        }
        catch( Exception $e )
        {
            $this->assertEquals( "密码不能短于6个字符" , $e->getMessage() );
        }
    }

    public function testUserRegister()
    {
        // $_REQUEST['email'] = 'test' . time() . '@autotest.com';
        $user = new FangFrame\Controller\User();
        
        // Email为空
        $_REQUEST['email'] = '';
        
        try{ $user->save(); } 
        catch( Exception $e ){ $this->assertEquals( "Email 地址不能为空" , $e->getMessage() ); } 

        // 密码长度
        $_REQUEST['email'] = 'test' . time() . '@autotest.com';
        $_REQUEST['password'] = '***';

        try{ $user->save(); } 
        catch( Exception $e ){ $this->assertEquals( "密码不能短于6个字符" , $e->getMessage() ); }

        $_REQUEST['password'] = '******************';

        try{ $user->save(); } 
        catch( Exception $e ){ $this->assertEquals( "密码不能长于12个字符" , $e->getMessage() ); }

        $_REQUEST['password'] = '******';
        $_REQUEST['password2'] = '';

        try{ $user->save(); } 
        catch( Exception $e ){ $this->assertEquals( "重复密码不能为空" , $e->getMessage() ); }

        $_REQUEST['password'] = '******';
        $_REQUEST['password2'] = '$$$$$$';

        try{ $user->save(); } 
        catch( Exception $e ){ $this->assertEquals( "两次输入的密码不一致" , $e->getMessage() ); }


        $_REQUEST['password2'] = '******';

        $this->assertEquals( $user->save() , "用户注册成功<script>location='/?m=user&a=login'</script>" );

            
        
    }
}