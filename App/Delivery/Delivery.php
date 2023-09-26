<?php

namespace App\Delivery;

use App\CityData;
use App\Company;

abstract class Delivery implements DeliveryITF
{
    public function __construct(
        public CityData $sourceCity,
        public CityData $targetCity,
        public Company  $company,
        public int      $weight,
        public string   $startedAt
    ){}


}