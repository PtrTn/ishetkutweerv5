<?php

namespace App\Factory;

use App\Dto\BuienradarResponse;

class BuienradarResponseFactory
{
    public function create(array $responseData): BuienradarResponse
    {
        return new BuienradarResponse();
    }
}