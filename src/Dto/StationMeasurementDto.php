<?php

namespace App\Dto;

class StationMeasurementDto
{
    public function __construct(
        public readonly string $id,
        public readonly int $stationid,
        public readonly string $stationname,
        public readonly float $lat,
        public readonly float $lon,
        public readonly string $regio,
        public readonly string $timestamp,
        public readonly string $weatherdescription,
        public readonly string $iconurl,
        public readonly string $fullIconUrl,
        public readonly string $graphUrl,
        public readonly ?string $winddirection,
        public readonly ?float $airpressure,
        public readonly ?float $temperature,
        public readonly ?float $groundtemperature,
        public readonly ?float $feeltemperature,
        public readonly ?float $visibility,
        public readonly ?float $windgusts,
        public readonly ?float $windspeed,
        public readonly ?float $windspeedBft,
        public readonly ?float $humidity,
        public readonly ?float $precipitation,
        public readonly ?float $sunpower,
        public readonly ?float $rainFallLast24Hour,
        public readonly ?float $rainFallLastHour,
        public readonly ?int $winddirectiondegrees,
    )
    {
    }
}