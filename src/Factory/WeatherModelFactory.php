<?php

namespace App\Factory;

use App\Dto\ForecastDto;
use App\Dto\StationMeasurementDto;
use App\Model\RainForecastModel;
use App\Model\WeatherModel;

class WeatherModelFactory
{
    public function __construct(
        private WeatherIconModelFactory $weatherIconModelFactory,
        private WindDirectionModelFactory $windDirectionModelFactory,
    )
    {
    }

    public function create(StationMeasurementDto $stationDto, ForecastDto $forecastDto): WeatherModel
    {
        $dateTime = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s', $stationDto->timestamp);
        if ($dateTime === false) {
            throw new \RuntimeException('Unable to format datetime');
        }

        return new WeatherModel(
            $stationDto->regio,
            $dateTime,
            (int) round($stationDto->temperature),
            $stationDto->weatherdescription,
            $this->weatherIconModelFactory->create($stationDto),
            $forecastDto->weatherreport->title,
            $forecastDto->weatherreport->summary,
            new RainForecastModel(), // todo, get rain data for upcoming hours
            (int) round($stationDto->feeltemperature),
            (int) round($stationDto->windspeedBft),
            (int) round($stationDto->precipitation),
            (int) round($stationDto->sunpower / 100),
            $this->windDirectionModelFactory->create($stationDto)
        );
    }
}