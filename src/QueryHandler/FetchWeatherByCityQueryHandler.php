<?php

namespace App\QueryHandler;

use App\ApiClient\BuienradarApiClient;
use App\Factory\BuienradarResponseDtoFactory;
use App\Factory\RainResponseDtoFactory;
use App\Factory\WeatherModelFactory;
use App\Filter\LocationFilter;
use App\Locator\CityLocator;
use App\Locator\IpLocator;
use App\Model\WeatherModel;
use App\Query\FetchWeatherByCityQuery;

class FetchWeatherByCityQueryHandler
{
    public function __construct(
        private CityLocator $cityLocator,
        private BuienradarApiClient $buienradarApiClient,
        private BuienradarResponseDtoFactory $buienradarResponseDtoFactory,
        private RainResponseDtoFactory $rainResponseDtoFactory,
        private LocationFilter $locationFilter,
        private WeatherModelFactory $modelFactory,
    )
    {
    }

    public function query(FetchWeatherByCityQuery $query): WeatherModel
    {
        // todo, prevent duplication with FetchWeatherByIpQueryHandler
        $location = $this->cityLocator->getLocationForCity($query->city);

        $weatherData = $this->buienradarApiClient->getWeatherData();
        $responseDto = $this->buienradarResponseDtoFactory->create($weatherData);

        $rainData = $this->buienradarApiClient->getRainData($location->lat, $location->lon);
        $rainDto = $this->rainResponseDtoFactory->create($rainData);

        // todo, filter incomplete data
        $stationDto = $this->locationFilter->filter($location, $responseDto->actual->stationmeasurements);

        return $this->modelFactory->create($stationDto, $responseDto->forecast, $rainDto, $query->city);
    }
}