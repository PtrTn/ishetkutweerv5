<?php

namespace App\Dto;

readonly class ForecastDto
{
    public function __construct(
        public string $id,
        public WeatherReportDto $weatherreport
    )
    {
    }

}