<?php

namespace App\Controller;

use App\Query\FetchWeatherByIpQuery;
use App\QueryHandler\FetchWeatherByIpQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    public function __construct(private FetchWeatherByIpQueryHandler $queryHandler)
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
        $weatherModel = $this->queryHandler->query($query);

        return $this->render('index.html.twig', ['data' => $weatherModel]);
    }
}