<?php

namespace App;

use PDO;

class CityData
{
    public int    $kladrId;
    public string $address;
    public string $name;
    public float  $geoLat;
    public float  $geoLon;

    /**
     * @return self[]
     */
    protected static function getList(): array
    {
        $qwe = qwe("
            select kladrId, address, name 
            from cities 
            order by name"
        );
        return $qwe->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function byKladr(int $kladrId): self
    {
        $qwe = qwe("
            select kladrId, address, name, geoLat, geoLon 
            from cities 
            where kladrId = :kladrId",
            ['kladrId' => $kladrId]
        );
        return $qwe->fetchObject(self::class);
    }
}