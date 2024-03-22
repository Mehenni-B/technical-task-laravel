<?php

namespace App\Services;

use App\Http\Resources\MealResource;
use App\Traits\HttpResponseTrait;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MealService
{
    use HttpResponseTrait;

    private $MEALS_API_URL = 'https://www.themealdb.com/api/json/v1/1/search.php?s=';

    public function fetchMeals()
    {
        try {
            $response = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])->get(env('MEALS_API_URL', $this->MEALS_API_URL));

            if ($response->status() === 200) {
                return self::successHttpResponse("Meals fetched successfully", MealResource::collection($response->collect()['meals']));
            } else {
                Log::error('############ Error fetching meals ############');
                Log::error($response->body());
                return self::errorHttpResponse("An error occurred while fetching meals", $response->status());
            }
        } catch (\Exception $e) {
            Log::error('############ Error fetching meals ############');
            Log::error($e->getMessage());
            return self::errorHttpResponse("An error occurred while fetching meals", 500);
        }
    }
}
