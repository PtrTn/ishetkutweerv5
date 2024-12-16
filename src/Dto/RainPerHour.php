<?php

namespace App\Dto;

readonly class RainPerHour
{
    public function __construct(
        public int $rainIntensity,
        public string $time
    )
    {
    }
}