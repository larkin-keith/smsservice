<?php

namespace Mrlian\Smsservice\Factory;

use Mrlian\Smsservice\Vendor\ASmsFactory;
use Mrlian\Smsservice\YunPian;

class YunPianFactory extends ASmsFactory {

    public function factoryMethod() {
        $platform = new YunPian();
        
        return $platform;
    }
}