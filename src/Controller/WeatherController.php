<?php

namespace App\Controller;

use App\Query\FetchWeatherByIpQuery;
use App\QueryHandler\FetchWeatherByIpQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    public function __construct(private FetchWeatherByIpQueryHandler $queryHandler)
    {
    }

    #[Route('/')]
    public function weatherByIp(): Response
    {
        // todo, grab ip from request.
        $query = new FetchWeatherByIpQuery();
        $weatherModel = $this->queryHandler->query($query);

        return $this->render('index.html.twig', ['data' => $weatherModel]);
    }
}