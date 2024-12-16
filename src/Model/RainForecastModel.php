<?php

namespace App\Model;

readonly class RainForecastModel
{
    public function __construct(public array $dataPoints)
    {
    }

    public function toJson(): array
    {
        return $this->dataPoints;
    }
}