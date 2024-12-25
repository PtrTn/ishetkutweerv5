<?php

namespace App\Repository;

use App\Dto\LocationDto;

class CityRepository
{
    public function getAllCityNames(): array
    {
        $cities = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'cities.json');
        $citiesWithProperties = json_decode($cities, true);
        return array_map(fn($cityWithProperties) => $cityWithProperties['city'], $citiesWithProperties);
    }

    public function getCityLocation(string $city): LocationDto
    {
        $cities = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'cities.json');
        $citiesWithProperties = json_decode($cities, true);
        foreach ($citiesWithProperties as $cityWithProperties) {
            if (strcasecmp($cityWithProperties['city'], $city) === 0) {
                return new LocationDto($cityWithProperties['latitude'], $cityWithProperties['longitude']);
            }
        }

        throw new \RuntimeException('Unable to find location for city');
    }
}