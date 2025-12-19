<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\CountryService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showData(
        CountryService $country
    ): JsonResponse {
        return response()->json($country->all());
    }
}
