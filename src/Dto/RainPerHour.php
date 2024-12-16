<?php

namespace App\Dto;

readonly class RainPerHour
{
    public function __construct(
        public int $rainInMm,
        public string $time
    )
    {
    }
}