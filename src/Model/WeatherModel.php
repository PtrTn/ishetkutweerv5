<?php

namespace App\Model;

readonly class WeatherModel
{
    public function __construct(
        public string $region,
        public \DateTimeImmutable $dateTime,
        public int $temperature,
        public string $shortDescription,
        public string $animationIcon,
        public string $title,
        public string $longDescription,
        public RainForecastModel $rainForecast,
        public int $feelTemperature,
        public int $windSpeed,
        public int $rain,
        public int $sunPower,
        public string $windDirectionText,
        public int $windDirectionDegrees,
    )
    {
    }
}