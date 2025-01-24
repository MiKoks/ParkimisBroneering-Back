<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'house_id' => House::factory(), // Automatically create a related house
            'name' => $this->faker->numberBetween(100, 999) . ' Room',
        ];
    }
}
