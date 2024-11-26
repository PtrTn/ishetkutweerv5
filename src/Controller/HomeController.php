<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function number(): Response
    {
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