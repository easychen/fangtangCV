<?php
if( !defined('DS') ) define( 'DS' , DIRECTORY_SEPARATOR );
define( "ROOT" , __DIR__ . DS . '..' .  DS . '..' ); 
define( "FROOT" , ROOT. DS . "framework" );
define( "VIEW" , FROOT. DS . "view" );
include ROOT . DS . 'vendor' . DS . 'autoload.php';

class UserCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
        $sql = "DELETE FROM `user` WHERE `email` LIKE '%@autotest.com' ";
        run_sql( $sql );
    }

    // tests
    // public function loginTest(AcceptanceTester $I)
    // {
    //     $I->amOnPage("/?m=user&a=login");
    //     $I->seeInTitle("用户登入");
    //     $I->fillField("email","thetwo@gmail.com");
    //     $I->fillField("password","php");
    //     $I->click("#login_button");
    //     $I->wait(1);
    //     $I->see("密码不能短于6个字符");
        
    // }


    public function cvTest(AcceptanceTester $I)
    {
        $I->resizeWindow(600, 800);
        // 注册用户
        $email = "test" . time() . "@autotest.com";
        $I->amOnPage("/?m=user&a=register");
        $I->seeInTitle("用户注册");
        $I->fillField("email", $email);
        $I->fillField("password","phpphp");
        $I->fillField("password2","phpphp");
        $I->click("#register_button");
        $I->wait(2);
        $I->seeInTitle("用户登入");

        // 登入用户
        $I->fillField("email",$email);
        $I->fillField("password","phpphp");
        $I->click("#login_button");
        $I->wait(1);
        $I->seeInTitle("我的简历");

        $I->click("#resume_add_link");
        $I->wait(1);

        $I->seeInTitle("添加简历");

        // 添加简历
        $I->fillField("title", "测试简历@test" );
        $I->fillField("content","# 某人的简历

  - 冷熊/男/1990 
  - 本科/北极大学计算机系 
  - 工作年限：3年
  - 微博：[@Easy](http://weibo.com/easy) （如果没有技术相关内容，也可以不放）
  - 技术博客：http://old.ftqq.com ( 使用GitHub Host的Big较高  )
  - Github：http://github.com/easychen ( 有原创repo的Github帐号会极大的提升你的个人品牌  )

  - 期望职位：PHP高级程序员，应用架构师
  - 期望薪资：税前月薪15k~20k，特别喜欢的公司可例外
  - 期望城市：北京");

        $I->click("#resume_add_button");

        $I->wait(1);

        $I->seeInTitle("我的简历");

        $I->see("测试简历@test");

        $I->click("测试简历@test");
        
        $I->wait(1);

        $I->switchToNextTab();
        
        $I->wait(1);
        $I->see("某人的简历");

        
        $I->switchToPreviousTab();
        //$I->see("测试简历@test");
        $I->click("编辑");
        
        $I->wait(1);
        $I->seeInTitle("修改简历");

        $I->fillField("title", "测试简历.更新后@test" );
        $I->fillField("content","# 某熊的简历

  - 冷熊/男/1990 
  - 本科/北极大学计算机系 
  - 工作年限：3年
  - 微博：[@Easy](http://weibo.com/easy) （如果没有技术相关内容，也可以不放）
  - 技术博客：http://old.ftqq.com ( 使用GitHub Host的Big较高  )
  - Github：http://github.com/easychen ( 有原创repo的Github帐号会极大的提升你的个人品牌  )

  - 期望职位：PHP高级程序员，应用架构师
  - 期望薪资：税前月薪15k~20k，特别喜欢的公司可例外
  - 期望城市：北京");

        $I->click("#resume_update_button");

        $I->wait(1);

        $I->seeInTitle("我的简历");

        $I->see("测试简历.更新后@test");

        $I->click("测试简历.更新后@test");
        
        $I->wait(1);

        $I->switchToNextTab(2);
        
        $I->wait(1);
        $I->see("某熊的简历");

        $I->switchToPreviousTab(2);

        $I->wait(1);

        $I->seeInTitle("我的简历");

        $I->click("删除");

        $I->seeInPopup("确定要删除这份简历么？");

        $I->acceptPopup();

        $I->wait(1);

        
        $I->dontsee("测试简历.更新后@test");

        $I->click(".navbar-toggler");

        $I->wait(1);

        $I->click("退出");

        $I->wait(1);

        $I->click(".navbar-toggler");

        $I->wait(1);

        $I->see("登入");


    }
}
