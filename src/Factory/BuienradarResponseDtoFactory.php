<?php

namespace App\Factory;

use App\Dto\ActualDto;
use App\Dto\BuienradarResponseDto;
use App\Dto\ForecastDto;
use App\Dto\WeatherReportDto;

class BuienradarResponseDtoFactory
{
    public function __construct(private StationMeasurementDtoFactory $stationMeasurementDtoFactory)
    {
    }

    public function create(array $responseData): BuienradarResponseDto
    {
        return new BuienradarResponseDto(
            new ActualDto(
                $responseData['actual']['$id'],
                $responseData['actual']['actualradarurl'],
                $responseData['actual']['sunrise'],
                $responseData['actual']['sunset'],
                $this->stationMeasurementDtoFactory->create($responseData['actual']['stationmeasurements']),
            ),
            new ForecastDto(
                $responseData['forecast']['$id'],
                new WeatherReportDto(
                    $responseData['forecast']['weatherreport']['$id'],
                    $responseData['forecast']['weatherreport']['published'],
                    $responseData['forecast']['weatherreport']['title'],
                    $responseData['forecast']['weatherreport']['summary'],
                    $responseData['forecast']['weatherreport']['text'],
                    $responseData['forecast']['weatherreport']['author'],
                    $responseData['forecast']['weatherreport']['authorbio'],
                )
            )
        );
    }
}