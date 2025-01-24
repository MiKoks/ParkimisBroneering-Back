<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    protected $model = House::class;

    public function definition()
    {
        return [
            'name' => $this->faker->streetName,
            'total_parking_spots' => $this->faker->numberBetween(5, 50),
        ];
    }
}
