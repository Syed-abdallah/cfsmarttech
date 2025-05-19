<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;

class PackageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_prices')->insert([
            [
                'package_type' => 'basic',
                'price' => 30000,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-17 09:33:49'
            ],
            [
                'package_type' => 'standard',
                'price' => 140000,
                'created_at' => '2025-05-17 09:33:49',
                'updated_at' => '2025-05-17 09:33:49'
            ],
            [
                'package_type' => 'premium',
                'price' => 41000,
                'created_at' => '2025-05-17 16:01:36',
                'updated_at' => '2025-05-17 16:01:36'
            ]
        ]);
    }


}
