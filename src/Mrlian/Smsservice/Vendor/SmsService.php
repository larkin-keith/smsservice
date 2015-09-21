<?php
namespace Mrlian\Smsservice\Vendor;

use Illuminate\Support\Facades\Facade;

class SmsService extends Facade {

    protected static function getFacadeAccessor() { 
        return 'SmsService'; 
    }

}