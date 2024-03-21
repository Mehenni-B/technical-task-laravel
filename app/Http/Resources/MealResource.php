<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['idMeal'],
            'name' => $this['strMeal'],
            'category' => $this['strCategory'],
            'area' => $this['strArea'],
            'instructions' => $this['strInstructions'],
            'image' => $this['strMealThumb'],
        ];;
    }
}
