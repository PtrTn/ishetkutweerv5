<?php

namespace App\Repository;

class CityRepository
{
    public function getAllCityNames()
    {
        $cities = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'cities.json');
        $citiesWithProperties = json_decode($cities, true);
        return array_map(fn($cityWithProperties) => $cityWithProperties['city'], $citiesWithProperties);
    }
}