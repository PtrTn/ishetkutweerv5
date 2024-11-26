<?php

namespace App\Filter;

use App\Dto\StationMeasurementDto;

class LocationFilter
{
    /** @var StationMeasurementDto[] $stationMeasurementDtos */
    public function filter(array $stationMeasurementDtos): StationMeasurementDto
    {
        // todo, filter based on lat/lon location
        foreach ($stationMeasurementDtos as $stationMeasurementDto) {
            if ($stationMeasurementDto->regio === 'Goes') {
                return $stationMeasurementDto;
            }
        }

        throw new \RuntimeException('Unable to find station');
    }
}