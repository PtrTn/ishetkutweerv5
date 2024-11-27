<?php

namespace App\Model;

readonly class WeatherIconModel
{
    public function __construct(
        public string $fileName
    )
    {
    }
}