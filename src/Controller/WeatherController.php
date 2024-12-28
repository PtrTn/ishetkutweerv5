<?php

namespace App\Controller;

use App\Exceptions\SorryCountryNotSupported;
use App\Query\FetchWeatherByCityQuery;
use App\Query\FetchWeatherByIpQuery;
use App\QueryHandler\FetchWeatherQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    public function __construct(private FetchWeatherQueryHandler $queryHandler)
    {
    }

    #[Route('/')]
    public function weatherByIp(Request $request): Response
    {
        $ip = $request->getClientIp();
        if ($ip === '127.0.0.1') {
            $ip = '77.170.193.100';
        }
        $query = new FetchWeatherByIpQuery($ip);
        try {
            $weatherModel = $this->queryHandler->queryByIp($query);
        } catch (SorryCountryNotSupported) {
            return $this->redirectToRoute('weather-by-city', ['city' => 'utrecht']);
        }

        return $this->render('index.html.twig', ['data' => $weatherModel]);
    }

    #[Route('/plaats/{city}', 'weather-by-city')]
    public function weatherByCity(string $city): Response
    {
        $query = new FetchWeatherByCityQuery($city);
        $weatherModel = $this->queryHandler->queryByCity($query);

        return $this->render('index.html.twig', ['data' => $weatherModel]);
    }
}