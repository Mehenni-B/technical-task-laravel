<?php

namespace Tests\Feature\Meal;

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
