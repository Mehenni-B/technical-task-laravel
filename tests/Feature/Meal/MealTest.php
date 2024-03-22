<?php

namespace Tests\Feature\Meal;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MealTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMealsEndpoint()
    {
        Http::fake([
            '*' => Http::response(['meals' => [
                ['idMeal' => '1', 'strMeal' => 'Meal 1', 'strCategory' => 'Category 1', 'strArea' => 'Area 1', 'strInstructions' => 'Instructions 1', 'strMealThumb' => 'Image 1'],
                ['idMeal' => '2', 'strMeal' => 'Meal 2', 'strCategory' => 'Category 2', 'strArea' => 'Area 2', 'strInstructions' => 'Instructions 2', 'strMealThumb' => 'Image 2'],
            ]], 200),
        ]);

        $response = $this->get(route('meals.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'category',
                    'area',
                    'instructions',
                    'image'
                ]
            ]
        ]);

        $response->assertJson([
            'message' => 'Meals fetched successfully'
        ]);
    }
}
