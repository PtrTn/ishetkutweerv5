<?php

namespace App\Model;

readonly class RainForecastModel
{
    public function toJson(): array
    {
        return [
            '10:00' => 1,
            '11:00' => 2,
            '12:00' => 0,
            '13:00' => 0,
            '14:00' => 2
        ];
    }
}