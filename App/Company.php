<?php

namespace App;

use App\Errors\DeliveryErr;
use PDO;


class Company
{
    public int    $id;
    public string $name;
    public int    $price;
    public int    $coefficient;
    public int    $speed;

    /**
     * @return self[]
     */
    public static function getList(): array
    {
        $qwe = qwe("select * from companies");
        return $qwe->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * @throws DeliveryErr
     */
    public function validate(): void
    {
        if($this->coefficient < 0){
            throw new DeliveryErr(
                'company has an invalid coefficient',
                'Компания передала некорректный коэффициент'
            );
        }
    }
}