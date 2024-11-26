<?php

namespace App\QueryHandler;

use App\ApiClient\BuienradarApiClient;
use App\Factory\BuienradarResponseFactory;
use App\Query\FetchBuienradarByIpQuery;

class FetchBuienradarByIpQueryHandler
{
    public function __construct(
        private BuienradarApiClient $apiClient,
        private BuienradarResponseFactory $responseFactory
    )
    {
    }

    public function query(FetchBuienradarByIpQuery $query): void
    {
        // todo, fetch client ip
        // todo, convert ip to lat/lon location
        $responseData = $this->apiClient->getData();
        dd($responseData);
        $responseDto = $this->responseFactory->create($responseData);
        // todo, filter based on lat/lon location
        // todo, convert to model used by view
    }
}