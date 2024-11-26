<?php

namespace App\Dto;

readonly class WeatherReportDto
{
    public function __construct(
        public string $id,
        public string $published,
        public string $title,
        public string $summary,
        public string $text,
        public string $author,
        public string $authorbio,
    )
    {
    }
}