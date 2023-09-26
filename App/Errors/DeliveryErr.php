<?php

namespace App\Errors;

use Symphograph\Bicycle\Errors\MyErrors;

class DeliveryErr extends MyErrors
{
    protected string $type = 'DeliveryErr';

    public function __construct(string $message = 'DeliveryErr', string $pubMsg = 'Ошибка Доставки', protected int $httpStatus = 500)
    {
        parent::__construct($message, $pubMsg, $httpStatus);
    }
}