<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call([
        //     PackageTypeSeeder::class,
        //        AdditionalCostSeeder::class,
        //                 PropertySizeSeeder::class,
        //                 RoomTypeSeeder::class,
        // PermissionSeeder::class,
        // ]);
         $this->call(SuperAdminRoleSeeder::class);
    }
}
