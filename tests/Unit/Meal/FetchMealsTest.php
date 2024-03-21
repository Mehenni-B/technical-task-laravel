<?php

namespace Tests\Unit\Meal;

use Tests\TestCase;
use App\Facades\Meal as MealService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;

class FetchMealsTest extends TestCase
{
    public function testFetchMealsSuccess()
    {
        Http::fake([
            '*' => Http::response(['meals' => [
                ['idMeal' => '1', 'strMeal' => 'Meal 1', 'strCategory' => 'Category 1', 'strArea' => 'Area 1', 'strInstructions' => 'Instructions 1', 'strMealThumb' => 'Image 1'],
                ['idMeal' => '2', 'strMeal' => 'Meal 2', 'strCategory' => 'Category 2', 'strArea' => 'Area 2', 'strInstructions' => 'Instructions 2', 'strMealThumb' => 'Image 2'],
            ]], 200),
        ]);

        $response = MealService::fetchMeals();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Meals fetched successfully', $response->original['message']);
        $this->assertArrayHasKey('data', $response->original);

        $jsonResponse = new TestResponse($response);

        $jsonResponse->assertJsonStructure([
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
    }

    public function testFetchMealsNotFound()
    {
        Http::fake([
            '*' => Http::response(['error' => 'Not Found'], 404),
        ]);

        $response = MealService::fetchMeals();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('An error occurred while fetching meals', $response->original['message']);
    }

    public function testFetchMealsFailureStatusCode()
    {
        Http::fake([
            '*' => Http::response(['error' => 'Server error'], 500),
        ]);

        $response = MealService::fetchMeals();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('An error occurred while fetching meals', $response->original['message']);
    }

    public function testFetchMealsEmptyResponse()
    {
        Http::fake([
            '*' => Http::response(['meals' => []], 200),
        ]);

        $response = MealService::fetchMeals();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());


        $this->assertEquals('Meals fetched successfully', $response->original['message']);
        $this->assertEmpty($response->original['data']);
    }

    public function testFetchMealsUnexpectedApiResponse()
    {
        Http::fake([
            '*' => Http::response('Unexpected response format', 200),
        ]);

        $response = MealService::fetchMeals();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('An error occurred while fetching meals', $response->original['message']);
    }
}

