<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('houses')->insert([
            ['name' => 'House A', 'total_parking_spots' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'House B', 'total_parking_spots' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'House C', 'total_parking_spots' => 30, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
