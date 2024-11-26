<?php

namespace App\QueryHandler;

use App\ApiClient\BuienradarApiClient;
use App\Factory\BuienradarResponseDtoFactory;
use App\Factory\WeatherModelFactory;
use App\Filter\LocationFilter;
use App\Model\WeatherModel;
use App\Query\FetchWeatherByIpQuery;

class FetchWeatherByIpQueryHandler
{
    public function __construct(
        private BuienradarApiClient $apiClient,
        private BuienradarResponseDtoFactory $responseFactory,
        private LocationFilter $locationFilter,
        private WeatherModelFactory $modelFactory,
    )
    {
    }

    public function query(FetchWeatherByIpQuery $query): WeatherModel
    {
        // todo, convert ip to lat/lon location
        $responseData = $this->apiClient->getData();
        $responseDto = $this->responseFactory->create($responseData);
        $stationDto = $this->locationFilter->filter($responseDto->actual->stationmeasurements);

        return $this->modelFactory->create($stationDto, $responseDto->forecast);
    }
}