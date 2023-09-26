<?php

namespace App\Delivery;

interface DeliveryITF
{
    public function getPrice();

    public function getPeriod(int $distance): int;
}