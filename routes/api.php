<?php

use App\Http\Controllers\Api\V1\MealController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
});
