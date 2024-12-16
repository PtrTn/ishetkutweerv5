<?php

namespace App\QueryHandler;

use App\ApiClient\BuienradarApiClient;
use App\Factory\BuienradarResponseDtoFactory;
use App\Factory\RainResponseDtoFactory;
use App\Factory\WeatherModelFactory;
use App\Filter\LocationFilter;
use App\Locator\IpLocator;
use App\Model\WeatherModel;
use App\Query\FetchWeatherByIpQuery;

class FetchWeatherByIpQueryHandler
{
    public function __construct(
        private IpLocator $ipLocator,
        private BuienradarApiClient $buienradarApiClient,
        private BuienradarResponseDtoFactory $buienradarResponseDtoFactory,
        private RainResponseDtoFactory $rainResponseDtoFactory,
        private LocationFilter $locationFilter,
        private WeatherModelFactory $modelFactory,
    )
    {
    }

    public function query(FetchWeatherByIpQuery $query): WeatherModel
    {
        $location = $this->ipLocator->getLocationForIp($query->ipAddress);

        $weatherData = $this->buienradarApiClient->getWeatherData();
        $responseDto = $this->buienradarResponseDtoFactory->create($weatherData);

        $rainData = $this->buienradarApiClient->getRainData($location->lat, $location->lon);
        $rainDto = $this->rainResponseDtoFactory->create($rainData);

        // todo, filter incomplete data
        $stationDto = $this->locationFilter->filter($location, $responseDto->actual->stationmeasurements);

        return $this->modelFactory->create($stationDto, $responseDto->forecast, $rainDto);
    }
}