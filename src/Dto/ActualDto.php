<?php

namespace App\Dto;

readonly class ActualDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $actualradarurl,
        public readonly string $sunrise,
        public readonly string $sunset,
        /** @var StationMeasurementDto[] */
        public readonly array $stationmeasurements,
    )
    {
    }

}