<?php 
$I = new ApiTester($scenario);

$email = 'user'.time().'@autotest.com';
$password = 'phpphp';

// 用户注册
$I->wantTo('create a user via api');
$I->sendPOST('/?m=user&a=save', ['email' => $email, 'password' => $password,'password2' => $password]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('用户注册成功');

// 用户登录
$I->wantTo('login a user via api');
$I->sendPOST('/?m=user&a=login_check', ['email' => $email, 'password' => $password]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('登入成功');

// 取得token
$ret = json_decode( $I->grabResponse() , true );
$token = $ret['data']['token'];

// echo $token;
// 添加简历
$I->wantTo('create a resume via api');
$I->sendPOST('/?m=resume&a=save', ['title' => "这是api测试@test", 'content' => "这里是API简历内容"]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('简历保存成功');

// 取得 rid 
$ret = json_decode( $I->grabResponse() , true );

// print_r( $ret );
$rid = $ret['data']['rid'];

// 读取简历内容
$I->wantTo('get a resume via api');
$I->sendPOST('/?m=resume&a=detail', ['id' => $rid ]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('这是api测试@test');

// 修改简历内容
$I->wantTo('update a resume via api');
$I->sendPOST('/?m=resume&a=update', ['id' => $rid , 'title' => "这是修改以后的api测试@test", 'content' => "这里是API简历内容V2" ]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('简历更新成功');

$I->wantTo('get a resume again via api');
$I->sendPOST('/?m=resume&a=detail', ['id' => $rid ]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('这是修改以后的api测试@test');

// 简历列表
$I->wantTo('get my resume list via api');
$I->sendGET('/?m=resume&a=list', []);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('这是修改以后的api测试@test');

// 删除简历
$I->wantTo('get a resume via api');
$I->sendPOST('/?m=resume&a=remove', ['id' => $rid ]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('done');

$I->wantTo('get a resume again via api');
$I->sendPOST('/?m=resume&a=detail', ['id' => $rid ]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->dontseeResponseContains('这是修改以后的api测试@test');
$I->seeResponseContains('简历不存在或已被删除');

// 用户登出
$I->wantTo('logout via api');
$I->sendGET('/?m=user&a=logout');
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
$I->seeResponseIsJson();
$I->seeResponseContains('done');

foreach( ['update','save','remove'] as $action )
{
    $I->sendGET('/?m=resume&a='.$action);
    $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    $I->seeResponseIsJson();
    $I->seeResponseContains('登入');
}



