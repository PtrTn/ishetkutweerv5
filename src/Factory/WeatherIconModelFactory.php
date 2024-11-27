<?php

namespace App\Factory;

use App\Dto\StationMeasurementDto;
use App\Model\WeatherIconModel;

class WeatherIconModelFactory
{
    private const BASE_STRING = 'https://www.buienradar.nl/resources/images/icons/weather/96x96/';
    private const FILE_EXTENSION = '.png';

    public function create(StationMeasurementDto $stationDto): WeatherIconModel
    {
        $icon = str_replace(
            [self::BASE_STRING, self::FILE_EXTENSION],
            '',
            $stationDto->fullIconUrl
        );
        if (strlen($icon) < 1 || strlen($icon) > 2) {
            throw new \RuntimeException(sprintf('Unable to parse weather icon "%s"', $icon));
        }

        $mapping = [
            'A' => 'sun',
            'B' => 'sun-cloud',
            'C' => 'cloud',
            'D' => 'sun-cloud-mist',
            'E' => 'sun-cloud-rain2',
            'F' => 'sun-cloud-rain1',
            'G' => 'sun-cloud-rain-thunder',
            'H' => 'sun-cloud-rain3',
            'I' => 'sun-cloud-snow2',
            'J' => 'sun-cloud',
            'K' => 'cloud-rain2',
            'M' => 'cloud-rain1',
            'N' => 'sun-mist',
            'O' => 'cloud-mist',
            'Q' => 'rain',
            'R' => 'sun-cloud',
            'S' => 'cloud-rain-thunder',
            'T' => 'cloud-snow2',
            'U' => 'sun-cloud-snow1',
            'V' => 'cloud-snow1',
            'W' => 'cloud-snow-rain',
            'X' => 'cloud-snow-thunder',
            'CC' => 'cloud',
            'QQ' => 'rain',
        ];

        if (!array_key_exists($icon, $mapping)) {
            throw new \RuntimeException(sprintf('Unable to find svg matching weather icon "%s"', $icon));
        }

        return new WeatherIconModel($mapping[$icon] . '.svg');
    }
}