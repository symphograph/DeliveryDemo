<?php

namespace App\Delivery;

class DeliverySlow extends Delivery
{
    const basedPrice = 150;
    public function getPrice(): float|int
    {
        $price = self::basedPrice;
        $price *= 1 + $this->company->coefficient / 100;
        return round($price, 2);
    }

    public function getPeriod(int $distance): int
    {
        $period = round($distance / $this->company->speed);
        return ceil($period / 24);
    }
}