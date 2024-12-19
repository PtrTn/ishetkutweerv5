<?php

declare(strict_types=1);

namespace App\Locator;

use App\Dto\StationMeasurementDto;
use Geokit\Position;
use function Geokit\distanceHaversine;

class WeatherStationLocator
{
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
        $from = Position::fromXY($latA, $lonA);
        $to = Position::fromXY($latB, $lonB);

        $distance = distanceHaversine($from, $to);

        return $distance->kilometers();
    }
}
