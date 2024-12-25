<?php

declare(strict_types=1);

namespace App\Locator;

use App\Dto\LocationDto;
use App\Repository\CityRepository;

class CityLocator
{
    public function __construct(private CityRepository $cityRepository)
    {
    }

    public function getLocationForCity(string $city): LocationDto
    {
        return $this->cityRepository->getCityLocation($city);
    }
}
