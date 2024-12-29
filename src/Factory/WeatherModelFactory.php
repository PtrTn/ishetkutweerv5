<?php

namespace App\Factory;

use App\Dto\ForecastDto;
use App\Dto\LocationDto;
use App\Dto\RainResponseDto;
use App\Dto\StationMeasurementDto;
use App\Model\WeatherModel;
use Psr\Log\LoggerInterface;

class WeatherModelFactory
{
    public function __construct(
        private WeatherIconModelFactory $weatherIconModelFactory,
        private WindDirectionModelFactory $windDirectionModelFactory,
        private RainForecastModelFactory $rainForecastModelFactory,
        private CityFactory $cityFactory,
        private LoggerInterface $logger
    )
    {
    }

    public function create(StationMeasurementDto $stationDto, ForecastDto $forecastDto, RainResponseDto $rainDto, LocationDto $locationDto): WeatherModel
    {
        $dateTime = \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s', $stationDto->timestamp);
        if ($dateTime === false) {
            $this->logger->warning('Unable to map date', ['date' => $stationDto->timestamp]);
            $dateTime = null;
        }

        $cities = $this->cityFactory->create();

        return new WeatherModel(
            $locationDto->city ?? 'Onbekend',
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