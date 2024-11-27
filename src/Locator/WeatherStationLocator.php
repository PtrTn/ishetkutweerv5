<?php

declare(strict_types=1);

namespace App\Locator;

use App\Dto\StationMeasurementDto;
use Geokit\LatLng;
use Geokit\Math;

class WeatherStationLocator
{
    private Math $math;

    public function __construct(Math $math)
    {
        $this->math = $math;
    }

    /** @param StationMeasurementDto[] $stationMeasurementDtos */
    public function findClosestStation(array $stationMeasurementDtos, float $targetLat, float $targetLon): ?StationMeasurementDto
    {
        $closestStation = null;
        $closestDistance = null;
        foreach ($stationMeasurementDtos as $stationMeasurementDto) {
            $distance = $this->getDistance(
                $targetLat,
                $targetLon,
                $stationMeasurementDto->lat,
                $stationMeasurementDto->lon
            );
            if (isset($closestDistance) && $distance >= $closestDistance) {
                continue;
            }

            $closestDistance = $distance;
            $closestStation = $stationMeasurementDto;
        }

        return $closestStation;
    }

    private function getDistance(float $latA, float $lonA, float $latB, float $lonB): float
    {
        $distance = $this->math->distanceHaversine(
            new LatLng($latA, $lonA),
            new LatLng($latB, $lonB)
        );

        return $distance->kilometers();
    }
}
