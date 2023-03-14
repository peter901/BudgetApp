<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Category;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'description' => $faker->sentence(4),
            'amount' => $faker->numberBetween(10000,100000),
            'date' => $faker->dateTime(),
            'category_id' =>function(){
                return Category::factory()->create()->id;
            }
        ];
    }
}
