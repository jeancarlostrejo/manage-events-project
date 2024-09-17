<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryCityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Country $country): JsonResponse
    {
        $country->load('cities:id,name,country_id');
        return response()->json($country->cities);
    }
}
