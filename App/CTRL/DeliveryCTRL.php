<?php

namespace App\CTRL;

use App\Delivery\DeliveryList;
use Symphograph\Bicycle\Api\Response;
use Symphograph\Bicycle\Errors\ApiErr;
use Symphograph\Bicycle\Errors\ValidationErr;
use Symphograph\Bicycle\Helpers;

class DeliveryCTRL
{
    /**
     * @throws ValidationErr
     * @throws ApiErr
     */
    public static function list(): void
    {
        //TODO валидацию в отдельный класс
        $allowedTypes = ['slow', 'fast'];

        in_array($_GET['type'], $allowedTypes)
        or throw new ValidationErr('invalid type', 'Неизвестный тип доставки');

        $sourceKladr = $_GET['sourceKladr']
            ?? throw new ValidationErr();

        $targetKladr = $_GET['targetKladr']
            ?? throw new ValidationErr();

        $weight = $_GET['weight']
            ?? throw new ValidationErr();

        Helpers::isDate($_GET['startedAt'] ?? '', 'Y-m-d H:i')
        or throw new ValidationErr('startedAt is invalid', 'Некорректная дата');

        $list = DeliveryList::get($sourceKladr, $targetKladr, $_GET['startedAt'], $weight, $_GET['type']);
        Response::data($list);
    }

}