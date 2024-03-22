<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Facades\Meal as MealService;

class MealController extends Controller
{
    /**
     * Display a listing of the meals.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing the fetched meals or an error message.
     */
    public function index()
    {
        return MealService::fetchMeals();
    }
}
