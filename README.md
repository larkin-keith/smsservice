短信验证码 For Laravel 4

目前接入平台有LuosiMao&YunPian后期将扩展其它平台

Installation

Require this package with composer:composer require mrlian/smsservice

Usage

Find the providers key in config/app.php and register the SmsService Service Provider.

    'providers' => [
        // ...
        'Mrlian\Smsservice\SmsserviceServiceProvider',
    ]

Find the aliases key in config/app.php.

    'aliases' => [
        // ...
        'SmsService' => 'Mrlian\Smsservice\Vendor\SmsService',
    ]

Configuration

To use your own settings, publish config.

$ php artisan config:publish mrlian/smsservice

Find the config in config/packages/mrlian/smsservice/config.php.

Example Usage

实例化一个短信平台.

$sms = SmsService::factory('YunPian');

$sms->sendSmsCode('yourPhoneNum', 'verificationCode');

可用方法：

1. $sms->getCode();  返回短信商信息代码0表示发送成功，其它代码自行查阅
2. $sms->getMsg();  返回短信商反馈信息

异常：（用于短信发送失败后切换平台）

    $sms = SmsService::factory('LuosiMao');
    $sms->sendSmsCode('yourPhoneNum', 'verificationCode');
    try {
        $sms->getCode();
    } catch (Mrlian\Smsservice\Vendor\SmsException $e) {
        $sms = SmsService::factory('YunPian');
    }
