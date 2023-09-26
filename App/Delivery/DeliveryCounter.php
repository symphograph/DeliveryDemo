<?php

namespace App\Delivery;

use App\Company;

class DeliveryCounter
{
    const earthRadius = 6371;

    public int   $distance;
    public Company $company;
    public string $deliveredAt;
    public int|float    $price;

    public function __construct(
        private readonly ?DeliveryITF $delivery = null,
        public string                 $error = ''
    )
    {
        if(!empty($error)){
            return;
        }
        $this->initDistance();
        $this->initPrice();
        $this->initDeliveredAt();
        $this->company = $delivery->company;
    }

    private function initDistance(): void
    {
        $this->distance = self::rangeBetweenGeoPoints(
            $this->delivery->sourceCity->geoLat,
            $this->delivery->sourceCity->geoLon,
            $this->delivery->targetCity->geoLat,
            $this->delivery->targetCity->geoLon
        );
    }

    private function initPrice(): void
    {
        $this->price = $this->delivery->getPrice();
        $this->price *= ceil($this->delivery->weight);
        $this->price *= ceil($this->distance / 100);
        $this->price = round($this->price, 2);
    }

    private function initDeliveredAt(): void
    {
        $period = $this->delivery->getPeriod($this->distance);
        $deliveredAt = strtotime($this->delivery->startedAt) + $period * 24 * 3600;
        $this->deliveredAt = date('Y-m-d', $deliveredAt);
    }

    public static function rangeBetweenGeoPoints(float $sourceLat, float $sourceLon, float $targetLat, float $targetLon): int
    {
        $sourceLat = deg2rad($sourceLat);
        $sourceLon = deg2rad($sourceLon);
        $targetLat = deg2rad($targetLat);
        $targetLon = deg2rad($targetLon);

        $d = sin(($targetLat - $sourceLat) / 2) ** 2
            + cos($sourceLat)
                * cos($targetLat)
                * sin(($targetLon - $sourceLon) / 2) ** 2;

        $d = sqrt($d);
        $d = asin($d);
        $d *= self::earthRadius * 2;
        return round($d);
    }

}