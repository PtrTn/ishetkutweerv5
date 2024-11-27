<?php

declare(strict_types=1);

namespace App\Locator;

use App\Dto\LocationDto;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;

class IpLocator
{
    public function __construct(private Reader $reader)
    {
    }

    public function getLocationForIp(string $ipAddress): LocationDto
    {
        try {
            $city = $this->reader->city($ipAddress);
        } catch (AddressNotFoundException $exception) {
            throw new \RuntimeException('Unable to geo locate address', 0, $exception);
        } catch (InvalidDatabaseException $exception) {
            throw new \RuntimeException('Unable to connect to geo location database', 0, $exception);
        }

        return new LocationDto(
            $city->location->latitude,
            $city->location->longitude
        );
    }
}
