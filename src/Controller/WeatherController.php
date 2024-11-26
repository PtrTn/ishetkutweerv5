<?php

namespace App\Controller;

use App\Query\FetchBuienradarByIpQuery;
use App\QueryHandler\FetchBuienradarByIpQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    public function __construct(private FetchBuienradarByIpQueryHandler $queryHandler)
    {
    }

    #[Route('/')]
    public function weatherByIp(): Response
    {
        $query = new FetchBuienradarByIpQuery();
        $this->queryHandler->query($query);
        // todo, plug model into view

        return $this->render('index.html.twig', [
            'windSpeed' => 6,
            'rainData' => [
                '10:00' => 1,
                '11:00' => 2,
                '12:00' => 0,
                '13:00' => 0,
                '14:00' => 2
            ]
        ]);
    }
}