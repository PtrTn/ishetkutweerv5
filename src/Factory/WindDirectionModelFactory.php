<?php

namespace App\Factory;

use App\Dto\StationMeasurementDto;
use App\Model\WindDirectionModel;

class WindDirectionModelFactory
{
    public function create(StationMeasurementDto $stationDto): WindDirectionModel
    {
        return new WindDirectionModel(
            $this->translateWindDirection($stationDto->winddirectiondegrees),
            $stationDto->winddirectiondegrees
        );
    }

    private function translateWindDirection(int $windDirectionInDegrees): string
    {
        if ($windDirectionInDegrees < 0 || $windDirectionInDegrees > 360) {
            throw new \RuntimeException('Wind degrees has to be between 0 and 360');
        }
        $translations = [
            1 => 'Noord',
            2 => 'Noord-Noord-Oost',
            3 => 'Noord-Oost',
            4 => 'Oost-Noord-Oost',
            5 => 'Oost',
            6 => 'Oost-Zuid-Oost',
            7 => 'Zuid-Oost',
            8 => 'Zuid-Zuid-Oost',
            9 => 'Zuid',
            10 => 'Zuid-Zuid-West',
            11 => 'Zuid-West',
            12 => 'West-Zuid-West',
            13 => 'West',
            14 => 'West-Noord-West',
            15 => 'Noord-West',
            16 => 'Noord-Noord-West',
        ];

        $directionIndex = (int) round(($windDirectionInDegrees / 22.5) + 1);

        return $translations[$directionIndex] ?? throw new \RuntimeException('Unable to map wind direction index to translation');
    }
}