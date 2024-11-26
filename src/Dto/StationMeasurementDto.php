<?php

namespace App\Dto;

readonly class StationMeasurementDto
{
    public function __construct(
        public string $id,
        public int $stationid,
        public string $stationname,
        public float $lat,
        public float $lon,
        public string $regio,
        public string $timestamp,
        public string $weatherdescription,
        public string $iconurl,
        public string $fullIconUrl,
        public string $graphUrl,
        public ?string $winddirection,
        public ?float $airpressure,
        public ?float $temperature,
        public ?float $groundtemperature,
        public ?float $feeltemperature,
        public ?float $visibility,
        public ?float $windgusts,
        public ?float $windspeed,
        public ?float $windspeedBft,
        public ?float $humidity,
        public ?float $precipitation,
        public ?float $sunpower,
        public ?float $rainFallLast24Hour,
        public ?float $rainFallLastHour,
        public ?int $winddirectiondegrees,
    )
    {
    }
}