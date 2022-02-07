<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(rand(3,6), true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 9, 999999),
            'category_id' => Category::get()->shuffle()->first()->id

               
            
        
        ];
    }
}
