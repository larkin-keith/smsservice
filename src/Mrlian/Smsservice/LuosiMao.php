<?php

namespace Mrlian\Smsservice;

use Mrlian\Smsservice\Vendor\SmsInterface;
use Mrlian\Smsservice\Vendor\SmsException;
use Config;

class LuosiMao implements SmsInterface {

    /** Api-Key
     *
     * @var key
     */
    private $key;

    /**
     * Api-Url
     *
     * @var url
     */
    private $url;

    /**
     * 短信发送返回的代码
     *
     * @var url
     */
    public $code;

    /**
     * 短信发送返回的信息
     *
     * @var url
     */
    public $msg;

    public function __construct()
    {
        $this->key = Config::get('smsservice::smsService.luosiMao.key');
        $this->url = Config::get('smsservice::smsService.luosiMao.requestUrl');
    }

    /**
     * 短信发送
     *
     * @var url
     */
    public function sendSmsCode($mobile, $verificationCode)
    {
        $params = [
            'mobile' => $mobile,
            'message' => '您的验证码是' . $verificationCode . ',有效时间为30分钟，请尽快验证，谢谢！【天天游戏】',
            'key' => 'api:key-' . $this->key,
        ];

        $send = $this->sendHandle($this->url, $params);

        $this->code = json_decode($send)->error;
        $this->msg = json_decode($send)->msg;
    }

    /**
     * 短信发送处理
     *
     * @param url 请求链接
     * @param params string or array 请求参数
     *
     * @return data 
     */
    public function sendHandle($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);

        curl_setopt($ch, CURLOPT_HTTP_VERSION  , CURL_HTTP_VERSION_1_0 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH , CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD  , $params['key']);

        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['mobile' => $params['mobile'], 'message' => $params['message']]);

        $res = curl_exec( $ch );
        curl_close( $ch );

        return $res;
    }

    /**
     * 获取短信发送后的返回代码
     *
     * @var url
     */
    public function getCode()
    {
        if ($this->code != 0) {
            throw new SmsException('短信发送失败，错误码为' . $this->code);
        }

        return $this->code;
    }

    /**
     * 获取短信发送后返回的信息
     *
     * @var url
     */
    public function getMsg()
    {
        return $this->msg;
    }


}