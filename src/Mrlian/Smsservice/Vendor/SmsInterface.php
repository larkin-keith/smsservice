<?php

namespace Mrlian\Smsservice\Vendor;

interface SmsInterface {

    public function sendHandle($url, $params);

    public function sendSmsCode($mobile, $verificationCode);

    public function getCode();
    
    public function getMsg();

}