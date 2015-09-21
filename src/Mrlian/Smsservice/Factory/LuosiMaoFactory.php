<?php

namespace Mrlian\Smsservice\Factory;

use Mrlian\Smsservice\Vendor\ASmsFactory;
use Mrlian\Smsservice\LuosiMao;

class LuosiMaoFactory extends ASmsFactory {

    public function factoryMethod() {
        $platform = new LuosiMao();

        return $platform;
    }
}