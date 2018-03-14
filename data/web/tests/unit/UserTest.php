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
    }

    // tests
    public function testSomeFeature()
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
}