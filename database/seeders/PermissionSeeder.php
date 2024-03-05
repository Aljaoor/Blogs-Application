<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $webPermissions = [
            ['name' => 'User Management', 'guard_name' => 'web'],
            ['name' => 'Roles Management', 'guard_name' => 'web'],
            ['name' => 'Categories Management', 'guard_name' => 'web'],
            ['name' => 'Tags Management', 'guard_name' => 'web'],
            ['name' => 'Posts Management', 'guard_name' => 'web'],

        ];

        $apiPermissions = [
            ['name' => 'Categories Management', 'guard_name' => 'api'],
            ['name' => 'Tags Management', 'guard_name' => 'api'],
            ['name' => 'Posts Management', 'guard_name' => 'api'],

        ];

        Permission::insert($webPermissions);
        Permission::insert($apiPermissions);
    }
}
