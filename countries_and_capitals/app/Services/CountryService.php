<?php

namespace App\Services;

class CountryService
{
    public function all(): array
    {
        return config('countries');
    }
}
