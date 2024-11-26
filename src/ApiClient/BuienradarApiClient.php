<?php

declare(strict_types=1);

namespace App\ApiClient;

use App\Dto\Buienradar\BuienradarnlDto;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BuienradarApiClient
{
    private const API_URL = 'https://data.buienradar.nl/2.0/feed/json';

    public function __construct(private HttpClientInterface $httpClient) {

    }

    public function getData(): array
    {
        try {
            $response = $this->httpClient->request('GET', self::API_URL);
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
}
