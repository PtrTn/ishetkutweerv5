<?php

namespace App\Filter;

use App\Dto\LocationDto;
use App\Dto\StationMeasurementDto;
use App\Locator\WeatherStationLocator;

class LocationFilter
{
    public function __construct(private WeatherStationLocator $weatherStationLocator)
    {
    }

    /** @var StationMeasurementDto[] $stationMeasurementDtos */
    public function filter(LocationDto $locationDto, array $stationMeasurementDtos): StationMeasurementDto
    {
        $station = $this->weatherStationLocator->findClosestStation($stationMeasurementDtos, $locationDto->lat, $locationDto->lon);

        if ($station === null) {
            throw new \RuntimeException('Unable to find station');
        }

        return $station;
    }
}