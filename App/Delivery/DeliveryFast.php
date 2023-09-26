<?php

namespace App\Delivery;

class DeliveryFast extends Delivery
{
    const shutdownHour = 18;

    public function getPrice(): int|float
    {
        return $this->company->price;
    }

    public function getPeriod(int $distance): int
    {
        $speed = $this->company->speed * 5;
        $period = round($distance / $speed);
        $period = ceil($period / 24);
        $orderHour = date('H',strtotime($this->startedAt));
        if($orderHour >= self::shutdownHour){
            $period += 1;
        }
        return $period;
    }
}