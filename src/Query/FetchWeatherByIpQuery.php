<?php

namespace App\Query;

readonly class FetchWeatherByIpQuery
{
    public function __construct(public string $ipAddress)
    {
    }
}