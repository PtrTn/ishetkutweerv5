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
        if (strlen($icon) !== 1) {
            throw new \RuntimeException('Unable to parse weather icon');
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
            'I' => 'sun-cloud-snow',
            'Q' => 'rain',
        ];

        if (!array_key_exists($icon, $mapping)) {
            throw new \RuntimeException('Unable to find svg matching weather icon');
        }

        return new WeatherIconModel($mapping[$icon] . '.svg');
    }
}