<?php

namespace App\Model;

readonly class WeatherModel
{
    const FEEL_TEMPERATURE_RANGE = 30;

    public function __construct(
        public string $region,
        public \DateTimeImmutable $dateTime,
        public int $temperature,
        public string $shortDescription,
        public WeatherIconModel $weatherIcon,
        public string $title,
        public string $longDescription,
        public RainForecastModel $rainForecast,
        public int $feelTemperature,
        public int $windSpeed,
        public int $rain,
        public int $sunPower,
        public WindDirectionModel $wind,
        public array $cities
    )
    {
    }

    public function getMinFeelsTemperature(): int
    {
        if ($this->feelTemperature > 0 && $this->feelTemperature < 30){
            return 0;
        }
        if ($this->feelTemperature <= 0) {
            return floor(($this->feelTemperature - 1) / 10) * 10;
        }

        return $this->getMaxFeelsTemperature() - self::FEEL_TEMPERATURE_RANGE;
    }

    public function getMaxFeelsTemperature(): int
    {
        if ($this->feelTemperature > 0 && $this->feelTemperature < 30){
            return 30;
        }
        if ($this->feelTemperature >= 30) {
            return ceil(($this->feelTemperature + 1) / 10) * 10;
        }

        return $this->getMinFeelsTemperature() + self::FEEL_TEMPERATURE_RANGE;
    }
}