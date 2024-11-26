<?php

namespace App\QueryHandler;

use App\ApiClient\BuienradarApiClient;
use App\Factory\BuienradarResponseDtoFactory;
use App\Query\FetchWeatherByIpQuery;

class FetchWeatherByIpQueryHandler
{
    public function __construct(
        private BuienradarApiClient $apiClient,
        private BuienradarResponseDtoFactory $responseFactory
    )
    {
    }

    public function query(FetchWeatherByIpQuery $query): void
    {
        // todo, fetch client ip
        // todo, convert ip to lat/lon location
        $responseData = $this->apiClient->getData();
        $responseDto = $this->responseFactory->create($responseData);
        dd($responseDto);
        // todo, filter based on lat/lon location
        // todo, convert to model used by view
    }
}