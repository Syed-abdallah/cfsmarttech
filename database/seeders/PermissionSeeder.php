<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Admin (cfadmin) resources with CRUD permissions
        $adminResources = [
            'product',
            'permission',
            'role',
            'user',
            'marquee',
            'slider',
            'partner',
            'commercial',
            'additional-cost',
            'roomtype',
            'order', // Admin order management
        ];

        $crudOperations = [
            'create',
            'view',
            'edit',
            'update',
            'delete',
        ];

        // Generate CRUD permissions for admin resources
        foreach ($adminResources as $resource) {
            foreach ($crudOperations as $operation) {
                $permissionName = "{$operation} {$resource}";
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web' // Admin guard
                ]);
            }
        }

        // Special admin-only permissions (non-CRUD)
        $adminSpecialPermissions = [
            'toggle marquee',
            'toggle slider',
            'toggle partner',
            'update order status',
            'view order invoice',
            'manage commercial prices',
            'manage additional costs',
            'manage room types',
        ];

        foreach ($adminSpecialPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web' // Admin guard
            ]);
        }

        $this->command->info('Admin (cfadmin) permissions seeded successfully!');
    }
}