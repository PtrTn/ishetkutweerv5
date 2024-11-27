<?php

namespace App\Twig;

use Carbon\Carbon;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class DateExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('date', [$this, 'formatDate']),
        ];
    }

    public function formatDate(\DateTimeInterface $dateTime, string $format): string
    {
        return Carbon::create($dateTime)->locale('nl')->translatedFormat($format);
    }
}