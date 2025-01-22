<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkingSpotsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('parking_spots')->insert([
            ['house_id' => 1, 'room_id' => 1, 'status' => 'available', 'vehicle_reg_number' => null, 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 1, 'room_id' => 2, 'status' => 'occupied', 'vehicle_reg_number' => 'ABC123', 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 2, 'room_id' => null, 'status' => 'available', 'vehicle_reg_number' => null, 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 3, 'room_id' => 4, 'status' => 'occupied', 'vehicle_reg_number' => 'XYZ789', 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 3, 'room_id' => 5, 'status' => 'available', 'vehicle_reg_number' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
