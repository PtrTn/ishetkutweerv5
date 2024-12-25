<?php

namespace App\Factory;

use App\Dto\ForecastDto;
use App\Dto\RainResponseDto;
use App\Dto\StationMeasurementDto;
use App\Model\RainForecastModel;
use App\Model\WeatherModel;

class WeatherModelFactory
{
    public function __construct(
        private WeatherIconModelFactory $weatherIconModelFactory,
        private WindDirectionModelFactory $windDirectionModelFactory,
        private RainForecastModelFactory $rainForecastModelFactory,
        private CityFactory $cityFactory,
    )
    {
    }

    public function create(StationMeasurementDto $stationDto, ForecastDto $forecastDto, RainResponseDto $rainDto, ?string $city): WeatherModel
    {
        $dateTime = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s', $stationDto->timestamp);
        if ($dateTime === false) {
            throw new \RuntimeException('Unable to format datetime');
        }

        $cities = $this->cityFactory->create();

        return new WeatherModel(
            $city ?? $stationDto->regio,
            $dateTime,
            (int) round($stationDto->temperature),
            $stationDto->weatherdescription,
            $this->weatherIconModelFactory->create($stationDto),
            $forecastDto->weatherreport->title,
            $forecastDto->weatherreport->summary,
            $this->rainForecastModelFactory->create($rainDto),
            (int) round($stationDto->feeltemperature),
            (int) round($stationDto->windspeedBft),
            (int) round($stationDto->precipitation),
            (int) round($stationDto->sunpower / 100),
            $this->windDirectionModelFactory->create($stationDto),
            $cities
        );
    }
}