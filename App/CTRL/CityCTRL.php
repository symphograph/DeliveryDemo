<?php

namespace App\CTRL;

use App\CityData;
use Symphograph\Bicycle\Api\Response;

class CityCTRL extends CityData
{
    public static function list(): void
    {
        $list = self::getList();
        Response::data($list);
    }
}