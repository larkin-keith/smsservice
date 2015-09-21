# 短信验证码 For Laravel 4
目前接入平台有LuosiMao&YunPian后期将扩展其它平台
# Installation
<p>Require this package with composer:</p>
<code>composer require mrlian/smsservice</code>

#Usage
<p>Find the <code>providers</code> key in <code>config/app.php</code> and register the SmsService Service Provider.</p>
```php
'providers' => [
    // ...
    'Mrlian\Smsservice\SmsserviceServiceProvider',
]
```
<p>Find the aliases key in <code>config/app.php</code>.</p>
```php
'aliases' => [
    // ...
    'SmsService' => 'Mrlian\Smsservice\Vendor\SmsService',
]
```

#Configuration
<p>To use your own settings, publish config.</p>
<code>$ php artisan config:publish mrlian/smsservice</code>
<p>Find the config in <code>config/packages/mrlian/smsservice/config.php.</code></p>

#Example Usage
<p>实例化一个短信平台.</p>
<p><code>$sms = SmsService::factory('YunPian');</code></p>
<p><code>$sms->sendSmsCode('yourPhoneNum', 'verificationCode');</code></p>
<p>可用方法：</p>
<ol>
<li><code>$sms->getCode();</code> // 返回短信商信息代码0表示发送成功，其它代码自行查阅</li>
<li><code>$sms->getMsg();</code> // 返回短信商反馈信息</li>
</ol>
<p>异常：（用于短信发送失败后切换平台）</p>
```php
$sms = SmsService::factory('LuosiMao');
$sms->sendSmsCode('yourPhoneNum', 'verificationCode');
try {
    $sms->getCode();
} catch (Mrlian\Smsservice\Vendor\SmsException $e) {
    $sms = SmsService::factory('YunPian');
}
```
