<?php


class UserCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage("_enter.php?m=user&a=login");
        $I->seeInTitle("用户登入");
        $I->fillField("email","thetwo@gmail.com");
        $I->fillField("password","php");
        $I->click("登入");
        $I->wait(1);
        $I->see("密码不能短于6个字符");
        
    }
}
