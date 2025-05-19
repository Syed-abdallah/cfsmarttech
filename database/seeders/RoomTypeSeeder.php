<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('room_prices')->insert([
            [
                'room_type' => 'bedroom',
                'price' => 129,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-18 13:31:00'
            ],
            [
                'room_type' => 'bathroom',
                'price' => 599,
                'created_at' => '2025-05-17 16:01:36',
                'updated_at' => '2025-05-18 13:30:18'
            ],
            [
                'room_type' => 'drawing',
                'price' => 134,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-18 13:31:13'
            ],
            [
                'room_type' => 'kitchen',
                'price' => 523,
                'created_at' => '2025-05-17 16:01:36',
                'updated_at' => '2025-05-17 16:01:36'
            ],
            [
                'room_type' => 'laundry',
                'price' => 21,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-17 09:33:49'
            ]
        ]);
    }
}