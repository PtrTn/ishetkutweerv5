<?php

namespace App\Dto;

readonly class ForecastDto
{
    public function __construct(
        public readonly string $id,
        public readonly WeatherReportDto $weatherreport
    )
    {
    }

}