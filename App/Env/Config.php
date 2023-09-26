<?php

namespace App\Env;

use Symphograph\Bicycle\Env\Env;
use Symphograph\Bicycle\Errors\ConfigErr;

class Config extends \Symphograph\Bicycle\Env\Config
{
    /**
     * @throws ConfigErr
     */
    public static function initEndPoints(): void
    {
        self::checkOrigin();
        //self::initEndPoint('/api/', ['POST', 'OPTIONS'], ['HTTP_ACCESSTOKEN' => '']);

    }
}