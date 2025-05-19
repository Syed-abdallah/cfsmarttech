<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalCostSeeder extends Seeder
{
    public function run()
    {
        DB::table('additional_costs')->insert([
            [
                'cost_type' => 'geyser',
                'price' => 120,
                'status' => 1,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-19 03:27:23'
            ],
            [
                'cost_type' => 'waterPump',
                'price' => 300,
                'status' => 1,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-17 09:33:49'
            ],
            [
                'cost_type' => 'installation',
                'price' => 500,
                'status' => 1,
                'created_at' => '2025-05-17 16:01:36',
                'updated_at' => '2025-05-17 16:01:36'
            ]
        ]);
    }
}