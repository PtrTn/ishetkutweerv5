<?php

namespace App\Query;

readonly class FetchWeatherByCityQuery
{
    public function __construct(public string $city)
    {
    }
}