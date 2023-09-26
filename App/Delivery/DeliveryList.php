<?php

namespace App\Delivery;

use App\CityData;
use App\Company;
use App\Errors\DeliveryErr;
use JetBrains\PhpStorm\ExpectedValues;
use Symphograph\Bicycle\Errors\ApiErr;
use Symphograph\Bicycle\Errors\AppErr;

class DeliveryList
{
    /**
     * @return DeliveryCounter[]
     * @throws ApiErr
     */
    public static function get(
        int $sourceKladr,
        int $targetKladr,
        string $startedAt,
        int $weight,
        #[ExpectedValues(['fast', 'slow'])]
        string $method
    ): array
    {

        $sourceCity = CityData::byKladr($sourceKladr);
        $targetCity = CityData::byKladr($targetKladr);
        $companies = Company::getList();
        //$startedAt = date('Y-m-d H:i:s');

        $arr = [];
        foreach ($companies as $company) {
            try {
                $company->validate();
            } catch (DeliveryErr $err) {
                $arr[] = new DeliveryCounter(error: $err->getMessage());
                continue;
            }

            $delivery = match ($method) {
                'fast' => new DeliveryFast($sourceCity, $targetCity, $company, $weight, $startedAt),
                'slow' => new DeliverySlow($sourceCity, $targetCity, $company, $weight, $startedAt),
                default => throw new AppErr(
                    "method $method does not exist",
                    'Произошла чудовищная ошибка'
                )
            };

            $arr[] = new DeliveryCounter($delivery);
        }
        return $arr;
    }
}