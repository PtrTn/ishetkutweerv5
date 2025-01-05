<?php

namespace App\Factory;

use App\Dto\StationMeasurementDto;
use App\Model\WindDirectionModel;
use Psr\Log\LoggerInterface;

class WindDirectionModelFactory
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function create(StationMeasurementDto $stationDto): WindDirectionModel
    {
        try {
            $windDirectionText = $this->translateWindDirection($stationDto->winddirectiondegrees);
        } catch (\RuntimeException $exception) {
            $this->logger->warning('Defaulting to API-provided wind direction text', ['exception' => $exception]);
            $windDirectionText = $stationDto->winddirection;
        }

        return new WindDirectionModel(
            $windDirectionText,
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

        if (!isset($translations[$directionIndex])) {
            throw new \RuntimeException('Unable to map wind direction index to translation');
        }

        return $translations[$directionIndex];
    }
}