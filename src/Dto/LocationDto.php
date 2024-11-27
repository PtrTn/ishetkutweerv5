<?php

declare(strict_types=1);

namespace App\Dto;

readonly class LocationDto
{
    public function __construct(
        public float $lat,
        public float $lon
    )
    {
    }
}
