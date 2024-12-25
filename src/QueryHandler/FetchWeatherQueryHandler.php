<?php

namespace App\QueryHandler;

use App\ApiClient\BuienradarApiClient;
use App\Dto\LocationDto;
use App\Factory\BuienradarResponseDtoFactory;
use App\Factory\RainResponseDtoFactory;
use App\Factory\WeatherModelFactory;
use App\Filter\LocationFilter;
use App\Locator\CityLocator;
use App\Locator\IpLocator;
use App\Model\WeatherModel;
use App\Query\FetchWeatherByCityQuery;
use App\Query\FetchWeatherByIpQuery;

class FetchWeatherQueryHandler
{
    public function __construct(
        private IpLocator $ipLocator,
        private CityLocator $cityLocator,
        private BuienradarApiClient $buienradarApiClient,
        private BuienradarResponseDtoFactory $buienradarResponseDtoFactory,
        private RainResponseDtoFactory $rainResponseDtoFactory,
        private LocationFilter $locationFilter,
        private WeatherModelFactory $modelFactory,
    )
    {
    }

    public function queryByIp(FetchWeatherByIpQuery $query): WeatherModel
    {
        $location = $this->ipLocator->getLocationForIp($query->ipAddress);

        return $this->extracted($location);
    }

    public function queryByCity(FetchWeatherByCityQuery $query): WeatherModel
    {
        $location = $this->cityLocator->getLocationForCity($query->city);

        return $this->extracted($location);
    }

    private function extracted(LocationDto $location): WeatherModel
    {
        $weatherData = $this->buienradarApiClient->getWeatherData();
        $responseDto = $this->buienradarResponseDtoFactory->create($weatherData);

        $rainData = $this->buienradarApiClient->getRainData($location->lat, $location->lon);
        $rainDto = $this->rainResponseDtoFactory->create($rainData);

        // todo, filter incomplete data
        $stationDto = $this->locationFilter->filter($location, $responseDto->actual->stationmeasurements);

        return $this->modelFactory->create($stationDto, $responseDto->forecast, $rainDto, $location);
    }
}