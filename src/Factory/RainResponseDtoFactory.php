<?php

namespace App\Factory;

use App\Dto\RainPerHour;
use App\Dto\RainResponseDto;

class RainResponseDtoFactory
{
    public function create(string $data): RainResponseDto
    {
        $dataPoints = array_map(fn(string $dataPoint) => explode('|', $dataPoint), array_filter(explode("\n", $data)));
        $rainDtos = [];
        foreach ($dataPoints as $dataPoint) {
            if (!isset($dataPoint[0]) || !isset($dataPoint[1])) {
                continue;
            }
            $rainDtos[] = new RainPerHour($dataPoint[0], $dataPoint[1]);
        }
        return new RainResponseDto($rainDtos);
    }
}