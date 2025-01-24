<?php

namespace Database\Factories;

use App\Models\ParkingSpot;
use App\Models\House;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParkingSpotFactory extends Factory
{
    protected $model = ParkingSpot::class;

    public function definition()
    {
        return [
            'house_id' => House::factory(), // Automatically create a related house
            'room_id' => Room::factory(),  // Automatically create a related room
            'status' => 'available',
            'vehicle_reg_number' => null, // Null when spot is available
        ];
    }
}
