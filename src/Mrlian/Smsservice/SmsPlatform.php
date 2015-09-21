<?php

namespace Mrlian\Smsservice;

// use Classes\SmsService\Factory\YunPianFactory as YunPianFactory;
// use Classes\SmsService\Factory\LuosiMaoFactory as LuosiMaoFactory;

class SmsPlatform {

    /**
     * 实例化短信工厂平台
     */
    public static function factory($platform)
    {
        $factory = "Mrlian\Smsservice\Factory\\". $platform ."Factory";

        $smsPlatform = new $factory;

        return $smsPlatform->factoryMethod();
    }
}