<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            ['house_id' => 1, 'name' => 'Room 101', 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 1, 'name' => 'Room 102', 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 2, 'name' => 'Room 201', 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 3, 'name' => 'Room 301', 'created_at' => now(), 'updated_at' => now()],
            ['house_id' => 3, 'name' => 'Room 302', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
