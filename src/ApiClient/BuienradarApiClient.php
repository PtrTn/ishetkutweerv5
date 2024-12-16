<?php

declare(strict_types=1);

namespace App\ApiClient;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BuienradarApiClient
{
    private const WEATHER_API_URL = 'https://data.buienradar.nl/2.0/feed/json';
    private const RAIN_API_URL = 'https://gadgets.buienradar.nl/data/raintext';

    public function __construct(private HttpClientInterface $httpClient) {

    }

    public function getWeatherData(): array
    {
        try {
            $response = $this->httpClient->request('GET', self::WEATHER_API_URL);
        } catch (TransportExceptionInterface $exception) {
            throw new \RuntimeException('Transport exception', 0, $exception);
        }

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException('Non 200-status returned');
        }

        try {
            $data = $response->getContent();
        } catch (\Exception $exception) {
            throw new \RuntimeException('Unable to get response contents', 0, $exception);
        }

        return json_decode($data, true);
    }

    public function getRainData(float $lat, float $lon): string
    {
        $query = http_build_query(['lat' => $lat, 'lon' => $lon]);
        try {
            $response = $this->httpClient->request('GET', self::RAIN_API_URL . '?' . $query);
        } catch (TransportExceptionInterface $exception) {
            throw new \RuntimeException('Transport exception', 0, $exception);
        }

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException('Non 200-status returned');
        }

        try {
            return $response->getContent();
        } catch (\Exception $exception) {
            throw new \RuntimeException('Unable to get response contents', 0, $exception);
        }
    }
}
