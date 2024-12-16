<?php

namespace App\Factory;

use App\Dto\RainResponseDto;
use App\Model\RainForecastModel;

class RainForecastModelFactory
{
    public function create(RainResponseDto $rainResponseDto): RainForecastModel
    {
        $dataPoints = [];
        foreach ($rainResponseDto->rainDtos as $rainDto) {
            $dataPoints[$rainDto->time] = $this->convertRainIntensityToMmPerHour($rainDto->rainIntensity);
        }

        $dataPoints = $this->groupIntoQuarterIncrements($dataPoints);

        return new RainForecastModel(array_slice($dataPoints, 0, 5, true));
    }

    private function convertRainIntensityToMmPerHour(int $rainIntensity): float
    {
        return round(pow(10, ($rainIntensity - 109) / 32), 1);
    }

    private function groupIntoQuarterIncrements(array $dataPoints): array
    {
        $groupedRainData = [];
        $groups = array_chunk($dataPoints, 3, true);
        foreach ($groups as $group) {
            $times = array_keys($group);
            $timeOfFirstInGroup = array_shift($times);
            $groupedRainData[$timeOfFirstInGroup] = array_sum($group);
        }

        return $groupedRainData;
    }
}