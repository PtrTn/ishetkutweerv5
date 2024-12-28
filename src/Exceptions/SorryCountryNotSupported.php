<?php

namespace App\Exceptions;

class SorryCountryNotSupported extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Unable to use locations outside of the Netherlands');
    }
}