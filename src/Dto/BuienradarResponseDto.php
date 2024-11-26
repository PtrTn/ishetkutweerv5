<?php

namespace App\Dto;

readonly class BuienradarResponseDto
{
    public function __construct(
        public ActualDto $actual,
        public ForecastDto $forecast,
    )
    {
    }
}