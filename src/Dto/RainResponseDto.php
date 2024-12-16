<?php

namespace App\Dto;

readonly class RainResponseDto
{
    /** @param RainPerHour[] $rainDtos */
    public function __construct(public array $rainDtos)
    {
    }
}