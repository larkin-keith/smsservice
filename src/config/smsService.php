<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | 短信平台配置文件
    |--------------------------------------------------------------------------
    |
    | 记录各个短信平台的apikey，api请求地址等...
    |
    */

    // LuosiMao 短信平台
    'luosiMao' => [
        'key' => '',
        'requestUrl' => 'https://sms-api.luosimao.com/v1/send.json',
    ],

    // 云片网 短信平台
    'yunPian' => [
        'key' => '',
        'requestUrl' => 'http://yunpian.com/v1/sms/tpl_send.json',
        'tplID' => '',
        'safeCodeTplID' => ''
    ],

    //...
];