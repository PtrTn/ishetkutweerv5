<?php

namespace App\Dto;

readonly class BuienradarResponseDto
{
    public function __construct(
        public readonly ActualDto $actual,
        public readonly ForecastDto $forecast,
    )
    {
    }
}