<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryCityController extends Controller
{
    public function __invoke(Country $country): JsonResponse
    {
        $country->load('cities:id,name,country_id');

        return response()->json($country->cities);
    }
}
