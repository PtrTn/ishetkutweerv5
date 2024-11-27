<?php

namespace App\Model;

readonly class WindDirectionModel
{
    public function __construct(
        public string $directionText,
        public int $directionInDegrees,
    )
    {
    }

}