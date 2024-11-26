<?php

namespace App\Dto;

readonly class ActualDto
{
    public function __construct(
        public string $id,
        public string $actualradarurl,
        public string $sunrise,
        public string $sunset,
        /** @var StationMeasurementDto[] */
        public array $stationmeasurements,
    )
    {
    }

}