<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySizeSeeder extends Seeder
{
    public function run()
    {
        DB::table('commercial_prices')->insert([
            [
                'size' => 1200,
                'price' => 15,
                'created_at' => '2025-05-17 18:15:25',
                'updated_at' => '2025-05-18 17:11:45'
            ],
            [
                'size' => 1800,
                'price' => 12,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-18 17:12:07'
            ],
            [
                'size' => 2200,
                'price' => 12,
                'created_at' => '2025-05-17 16:01:36',
                'updated_at' => '2025-05-18 17:12:10'
            ],
            [
                'size' => 3000,
                'price' => 30,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-18 17:12:18'
            ]
        ]);
    }
}