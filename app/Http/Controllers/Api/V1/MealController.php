<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Facades\Meal as MealService;

class MealController extends Controller
{
    public function index()
    {
        return MealService::fetchMeals();
    }
}
