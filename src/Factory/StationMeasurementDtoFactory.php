<?php

namespace App\Factory;

use App\Dto\StationMeasurementDto;

class StationMeasurementDtoFactory
{
    /** @return StationMeasurementDto[] */
    public function create(array $stationmeasurements): array
    {
        $stationMeasurementDtos = [];
        foreach ($stationmeasurements as $stationmeasurement) {
            $stationMeasurementDtos[] = new StationMeasurementDto(
                $stationmeasurement['$id'],
                $stationmeasurement['stationid'],
                $stationmeasurement['stationname'],
                $stationmeasurement['lat'],
                $stationmeasurement['lon'],
                $stationmeasurement['regio'],
                $stationmeasurement['timestamp'],
                $stationmeasurement['weatherdescription'],
                $stationmeasurement['iconurl'],
                $stationmeasurement['fullIconUrl'],
                $stationmeasurement['graphUrl'],
                $stationmeasurement['winddirection'] ?? null,
                $stationmeasurement['airpressure'] ?? null,
                $stationmeasurement['temperature'] ?? null,
                $stationmeasurement['groundtemperature'] ?? null,
                $stationmeasurement['feeltemperature'] ?? null,
                $stationmeasurement['visibility'] ?? null,
                $stationmeasurement['windgusts'] ?? null,
                $stationmeasurement['windspeed'] ?? null,
                $stationmeasurement['windspeedBft'] ?? null,
                $stationmeasurement['humidity'] ?? null,
                $stationmeasurement['precipitation'] ?? null,
                $stationmeasurement['sunpower'] ?? null,
                $stationmeasurement['rainFallLast24Hour'] ?? null,
                $stationmeasurement['rainFallLastHour'] ?? null,
                $stationmeasurement['winddirectiondegrees'] ?? null,
            );
        }

        return $stationMeasurementDtos;
    }
}