<?php

namespace App\Filter;

use App\Dto\StationMeasurementDto;

class IncompleteDataFilter
{
    /**
     * @var StationMeasurementDto[] $stationMeasurementDtos
     * @return StationMeasurementDto[]
     */
    public function filter(array $stationMeasurementDtos): array
    {
        $validStations = [];
        foreach ($stationMeasurementDtos as $stationMeasurementDto) {
            if ($this->isValid($stationMeasurementDto)) {
                $validStations[] = $stationMeasurementDto;
            }
        }
        return $validStations;
    }

    private function isValid(StationMeasurementDto $dto): bool
    {
        return isset(
            $dto->temperature,
            $dto->feeltemperature,
            $dto->windspeedBft,
            $dto->precipitation,
            $dto->sunpower,
            $dto->winddirectiondegrees,
        );
    }
}