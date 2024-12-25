<?php

namespace App\Factory;

use App\Repository\CityRepository;

class CityFactory
{
    public function __construct(private CityRepository $cityRepository)
    {
    }

    public function create(): array
    {
        return $this->cityRepository->getAllCityNames();
    }
}