<?php

namespace Mrlian\Smsservice;

use Mrlian\Smsservice\Vendor\SmsInterface;
use Mrlian\Smsservice\Vendor\SmsException;
use Config;

class YunPian implements SmsInterface {

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
     * tplID
     *
     * @var tplID
     */
    private $tplID;

    /**
     * safeCodeTplI
     *
     * @var safeCodeTplI
     */
    private $safeCodeTplID;

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
        $this->key = Config::get('smsservice::smsService.yunPian.key');
        $this->url = Config::get('smsservice::smsService.yunPian.requestUrl');
        $this->tplID = Config::get('smsservice::smsService.yunPian.tplID');
        $this->safeCodeTplID = Config::get('smsservice::smsService.yunPian.safeCodeTplID');
    }

    /**
     * 短信发送
     *
     * @param mobile string 手机号码
     * @param verificationCode string 验证码
     * 
     * @return void
     */
    public function sendSmsCode($mobile, $verificationCode)
    {
        $params = "apikey=" . $this->key 
            . "&tpl_id=" . $this->tplID 
            . "&tpl_value=" . urlencode('#code#='.$verificationCode) 
            . "&mobile=" . $mobile;

        $send = $this->sendHandle($this->url, $params);

        $this->code = json_decode($send)->code;
        $this->msg = json_decode($send)->msg;
    }

    /**
     * 短信发送处理
     *
     * @param url 请求链接
     * @param string 请求参数
     *
     * @return data 
     */
    public function sendHandle($url, $params)
    {
        $data = "";
        $info = parse_url($url);
        $fp = fsockopen($info["host"],80,$errno,$errstr,30);

        if(! $fp){
            return $data;
        }

        $head="POST ".$info['path']." HTTP/1.0\r\n";
        $head.="Host: ".$info['host']."\r\n";
        $head.="Referer: http://".$info['host'].$info['path']."\r\n";
        $head.="Content-type: application/x-www-form-urlencoded\r\n";
        $head.="Content-Length: ".strlen(trim($params))."\r\n";
        $head.="\r\n";
        $head.=trim($params);
        $write=fputs($fp,$head);
        $header = "";
        while ($str = trim(fgets($fp,4096))) {
            $header.= $str;
        }
        while (!feof($fp)) {
            $data .= fgets($fp,4096);
        }

        return $data;
    }

    /**
     * 获取短信发送后的返回代码
     *
     * @return void
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
     * @return void
     */
    public function getMsg()
    {
        return $this->msg;
    }


}