<?php

namespace Database\Factories;

use App\Models\Cat;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatFactory extends Factory
{
     
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            'name' =>json_encode([
                'en' => $this->faker->word(),
                'ar' => $this->faker->word()
            ])
        ];
    }
}
